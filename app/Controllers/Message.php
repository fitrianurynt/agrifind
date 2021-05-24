<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ProfileModel;

class Message extends BaseController
{
  protected $messageModel;

  public function __construct()
  {
    $this->messageModel = new MessageModel();
    $this->profileModel = new ProfileModel();
  }

  public function index()
  {
    //set session
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');
    // check session if user is logged in

    $messages = $this->messageModel->where('receiver_id', $session_id)->findAll();
    // foreach($messages as $m){
    //   $sender_id = $m['sender_id'];
    //   $query = $this->profileModel->select('name', 'email')->where('id', $sender_id)->get();

    //   dd($sender_id, $query);

    //   $sender[] = [$query];
    // }
    if(!$messages) $sender = [];
    foreach($messages as $m){
      $sender_id = $m['sender_id'];
      $query = $this->profileModel->query("SELECT id, name, email FROM user WHERE id= $sender_id");

      $sender[] = $query->getResult()[0];

    }

    $data = [
      'title' => 'Messages | Agrifind',
      'message' => $messages,
      'sender' => $sender

    ];

    return view('/message/index', $data);

    dd($messages);

  }

  public function deleteMessage($message_id)
  {
    $this->messageModel->where('id', $message_id)->delete();

    return redirect()->to('/message');
  }
}
