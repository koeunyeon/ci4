<?php
namespace App\Controllers;

use App\Entities\SampleEntity;
use App\Models\SampleEntityModel;


class Entity extends BaseController
{
    public function regist()
    {
        $sampleEntity = new SampleEntity();
        $sampleEntity->fill(
            $this->request->getPost()
        );

        $sampleEntityModel = new SampleEntityModel();
        $last_insert_id = $sampleEntityModel->insert($sampleEntity);
        $resultEntity = $sampleEntityModel->find($last_insert_id);

        $check_user_result = $resultEntity->checkUser($this->request->getPost('login_pw'));

        $full_data = $resultEntity->getFullData();

        return $this->response->setJSON([
            'post_data' => $this->request->getPost(),
            'insert_entity' => $sampleEntity,
            'result_entity' => $resultEntity,
            'check_user_result' => $check_user_result,
            'full_data' => $full_data
        ]);
    }
}