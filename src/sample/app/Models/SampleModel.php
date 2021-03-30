<?php


namespace App\Models;

use CodeIgniter\Model; 

class SampleModel extends Model
{
    protected $table = 'sample';
    protected $allowedFields = ['name','age'];
    protected $primaryKey = "sample_id";
}