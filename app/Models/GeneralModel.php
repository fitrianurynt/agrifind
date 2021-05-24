<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
  protected $table          = 'general';
  protected $allowedFields  = ['about_me', 'phone', 'experience', 'profession'];
}
