<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
  protected $table      = 'user';
  protected $allowedFields = ['username', 'email', 'name', 'nim', 'faculty', 'department', 'password'];


}
