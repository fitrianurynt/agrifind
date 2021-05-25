<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
  protected $table      = 'user';
  protected $allowedFields = ['username', 'name', 'email', 'nim', 'faculty', 'avatar', 'header', 'cv', 'batch', 'availability', 'department', 'password'];

  public function search($keyword)
  {
    // $builder = $this->table('user');
    // $builder->like('name', $keyword);
    // return $builder;

    return $this->table('user')->like('name', $keyword)->orLike('nim', $keyword)->orLike('department', $keyword)->orLike('availability', $keyword)->orLike('batch', $keyword); 
  }
}
