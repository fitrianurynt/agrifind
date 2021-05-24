<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
  protected $table      = 'user';
  protected $allowedFields = ['username', 'name', 'email', 'nim', 'faculty', 'avatar', 'header', 'cv', 'availability', 'department', 'password'];

  
}
