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
}