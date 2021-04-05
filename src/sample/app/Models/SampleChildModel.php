<?php
namespace App\Models;
use CodeIgniter\Model;

class SampleChildModel extends Model
{
    protected $table = 'sample_child';
    protected $allowedFields = ['sample_parent_id', 'child_name']; // (1)
}