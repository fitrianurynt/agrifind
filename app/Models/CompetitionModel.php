<?php

namespace App\Models;

use CodeIgniter\Model;

class CompetitionModel extends Model
{
  protected $table      = 'competition';
  protected $allowedFields = ['user_id', 'name', 'rank', 'organiser', 'field', 'description'];
}
