<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ProfileModel;

class Message extends BaseController
{
  protected $messageModel;
  protected $session;

  public function __construct()
  {
    $this->messageModel = new MessageModel();
    $this->profileModel = new ProfileModel();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    //get user id from session
    $session_id = $this->session->get('id');

    $messages = $this->messageModel->where('receiver_id', $session_id)->findAll();
    if(!$messages) $sender = [];

    // foreach($messages as $m){
    //   $sender_id = $m['sender_id'];
    //   $query = $this->profileModel->query("SELECT id, name, email FROM user WHERE id= $sender_id");

    //   $sender[] = $query->getResult()[0];

    // }

    foreach($messages as $m){
      $query = $this->profileModel->where('id', $m['sender_id'])->select('id, name, email')->first();

      $sender[] = [
        'id'=>$query['id'], 
        'name'=>$query['name'], 
        'email'=>$query['email'],
        'subject' =>$m['subject'],
        'message' => $m['message'],
        'created_at'=>$m['created_at'],
        'message_id' =>$m['id']
      ];

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
