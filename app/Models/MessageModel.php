<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
  protected $table      = 'message';
  protected $allowedFields = ['sender_id', 'receiver_id', 'subject', 'message'];

  
}
