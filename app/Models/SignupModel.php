<?php

namespace App\Models;

use CodeIgniter\Model;

class SignupModel extends Model
{
  protected $table      = 'user';
  protected $allowedFields = ['username', 'email', 'name', 'nim', 'department', 'batch', 'avatar', 'header', 'cv', 'availability', 'password'];


}
