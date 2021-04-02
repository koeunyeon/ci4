<?php
namespace App\Models;
use CodeIgniter\Model;

class SampleEntityModel extends Model
{
    protected $table = 'sample_entity';
    protected $allowedFields = ['person_name', 'age', 'login_pw'];
    protected $primaryKey = "sample_entity_id";

    protected $returnType = "App\Entities\SampleEntity";
}