<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminLogin extends Model
{
    protected $table = 'users';
    protected $allowedFields = [''];
    protected $id = 'id';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
