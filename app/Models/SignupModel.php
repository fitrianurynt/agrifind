<?php

namespace App\Models;

use CodeIgniter\Model;

class SignupModel extends Model
{
  protected $table      = 'user';
  protected $allowedFields = ['username', 'email', 'name', 'nim', 'faculty', 'avatar', 'header', 'cv', 'availability', 'department', 'password'];


}
