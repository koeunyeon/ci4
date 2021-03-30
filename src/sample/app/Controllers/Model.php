<?php


namespace App\Controllers;


use App\Models\SampleModel;

class Model extends BaseController
{
    public function create()
    {
        $sampleModel = new SampleModel();
        $data = [
            'name' => 'ci4',
            'age' => 1
        ];

        try {
            $result = $sampleModel->insert($data);
            return "$result";
        } catch (\ReflectionException $e) {
            return $e->getMessage();
        } catch(\DataException $e){
            return $e->getMessage();
        }
    }
	
	public function readall(): \CodeIgniter\HTTP\Response
	{
		$sampleModel = new SampleModel();
		$data = $sampleModel
			->where('name', 'ci4')
			->findAll();

		$last_query = $sampleModel->db->getLastQuery();
		error_log(print_r($last_query, true));

		return $this->response->setJSON($data);
	}

	public function readfirst(): \CodeIgniter\HTTP\Response
	{
		$sampleModel = new SampleModel();
		$data = $sampleModel
				->where(['name'=>'ci4'])
				->orderBy('sample_id', 'desc')
				->first();

		error_log($sampleModel->db->showLastQuery());


		return $this->response->setJSON($data);
	}

	public function find(){
		$sampleModel = new SampleModel();
		$data = $sampleModel->find(1);
		return $this->response->setJSON($data);
	}
	
	public function update()
	{
		$sampleModel = new SampleModel();
		$sampleModel->update(1, ['name' => 'update']);

		return $this->response->setJSON($sampleModel->find(1));

	}

	public function save()
	{
		$sampleModel = new SampleModel();
		$sample_data = $sampleModel->find(1);
		$sample_data['name'] = "save";
		$sampleModel->save($sample_data);
		return $this->response->setJSON($sampleModel->find(1));
	}

	public function qbupdate()
	{
		$sampleModel = new SampleModel();
		$sampleModel
			->where("sample_id", 1)
			->set(['name' => 'qbupdate'])
			->update();

		return $this->response->setJSON($sampleModel->where('sample_id', 1)->first());
	}
	
	public function delete()
	{
		$sampleModel = new SampleModel();
		$sampleModel->delete(1);
		return $this->response->setJSON($sampleModel->find(1));
	}
}