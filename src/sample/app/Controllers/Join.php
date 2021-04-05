<?php
namespace App\Controllers;
use App\Models\SampleParentModel;

class Join extends BaseController
{
    public function index()
    {
        $parentModel = new SampleParentModel();
        $all_result = $parentModel
            ->join("sample_child", "sample_parent.sample_parent_id = sample_child.sample_parent_id")
            ->orderBy("sample_parent.parent_name")
            ->findAll();

        return view("join", ['all_result' => $all_result]);
    }
}