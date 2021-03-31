<?php


namespace App\Models;


use CodeIgniter\Model;

class RichModel  extends Model
{
    protected $table = 'sample_rich';
    protected $allowedFields = ['name','age'];
    protected $primaryKey = "sample_rich_id";

    protected $useSoftDeletes = true; // (1)
    protected $useTimestamps = true; // (2)
}