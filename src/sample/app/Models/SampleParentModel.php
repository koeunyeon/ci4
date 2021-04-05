<?php


namespace App\Models;


use CodeIgniter\Model;

class SampleParentModel extends Model
{
    protected $table = 'sample_parent';
    protected $allowedFields = ['parent_name'];
}