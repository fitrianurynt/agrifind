<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowModel extends Model
{
  protected $table      = 'follow';
  protected $allowedFields = ['follower_id', 'following_id'];
}
