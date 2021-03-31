<?php


namespace App\Controllers;


use App\Models\RichModel;

class Rich extends BaseController
{
    public function create()
    {
        $richModel = new  RichModel();
        // (1)
        $last_insert_id = $richModel->insert([
            'name' => 'rich',
            'age' => 22
        ]);

        $find_result = $richModel->find($last_insert_id);
        return $this->response->setJSON($find_result);
    }

    public function save($id, $name, $age) // (2)
    {
        $richModel = new  RichModel();
        $richData = $richModel->find($id);
        if ($richData === null) { // (3)
            $richData = [];
        }

        // (4)
        $richData['name'] = $name;
        $richData['age'] = $age;
        
        $richModel->save($richData); // (5)
        
        $last_insert_id = $richModel->getInsertID(); // (6)

        if ($last_insert_id == null) { // (7)
            $last_insert_id = $richData['sample_rich_id'];
        }

        $last_insert_data = $richModel->find($last_insert_id); // (8)
        return $this->response->setJSON($last_insert_data);
    }

    public function remove($id)
    {
        $richModel = new  RichModel();
        $richModel->delete($id); // (9)

        $select_result_before = $richModel->find($id); // (10)
        $with_deleted_result_before = $richModel->withDeleted()->find($id);  // (11)

        $richModel->purgeDeleted();  // (12)

        $select_result_after = $richModel->find($id);  // (13)
        $with_deleted_result_after = $richModel->withDeleted()->find($id);  // (14)

        return $this->response->setJSON([  // (15)
            'select_result_before' => $select_result_before,
            'with_deleted_result_before' => $with_deleted_result_before,
            'select_result_after' => $select_result_after,
            'with_deleted_result_after' => $with_deleted_result_after,
        ]);
    }
}