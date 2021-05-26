<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
  protected $table          = 'general';
  protected $allowedFields  = ['user_id','about_me', 'phone', 'experience', 'profession'];
}
