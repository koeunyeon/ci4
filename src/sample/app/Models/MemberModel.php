<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members';
    protected $allowedFields = ['social_name', 'identifier', 'member_name'];
    protected $primaryKey = "member_id";

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}
