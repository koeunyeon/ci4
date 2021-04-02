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

    public function save($id, $name, $age)
    {
        $richModel = new  RichModel();
        $richData = $richModel->find($id);
        if ($richData === null) {
            $richData = [];
        }
        
        $richData['name'] = $name;
        $richData['age'] = $age;
        
        $richModel->save($richData);
        
        $last_insert_id = $richModel->getInsertID();

        if ($last_insert_id == null) {
            $last_insert_id = $richData['sample_rich_id'];
        }

        $last_insert_data = $richModel->find($last_insert_id);
        return $this->response->setJSON($last_insert_data);
    }

    public function remove($id)
    {
        $richModel = new  RichModel();
        $richModel->delete($id);

        $select_result_before = $richModel->find($id);
        $with_deleted_result_before = $richModel->withDeleted()->find($id);

        $richModel->purgeDeleted();

        $select_result_after = $richModel->find($id);
        $with_deleted_result_after = $richModel->withDeleted()->find($id);

        return $this->response->setJSON([
            'select_result_before' => $select_result_before,
            'with_deleted_result_before' => $with_deleted_result_before,
            'select_result_after' => $select_result_after,
            'with_deleted_result_after' => $with_deleted_result_after,
        ]);
    }
	
	public function valid($name, $age)
	{
		$richModel = new  RichModel();
		$save_result = $richModel->save([
			'name' => $name,
			'age' => $age
		]);

		$errors = $richModel->errors();

		return $this->response->setJSON([
			'result' => $save_result,
			'errors' => $errors
		]);
	}
}