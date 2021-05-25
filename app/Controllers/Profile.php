<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\GeneralModel;
use App\Models\CompetitionModel;
use App\Models\SkillModel;
use App\Models\MessageModel;

class Profile extends BaseController
{
  protected $profileModel;
  protected $generalModel;
  protected $competitionModel;
  protected $skillModel;
  protected $messageModel;
  protected $session;

  public function __construct()
  {
    $this->profileModel = new ProfileModel();
    $this->generalModel = new GeneralModel();
    $this->competitionModel = new CompetitionModel();
    $this->skillModel = new SkillModel();
    $this->messageModel = new MessageModel();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    //get user id from session
    $session_id = $this->session->get('id');

    $user = $this->profileModel->where('id', $session_id)->first();
    $general = $this->generalModel->where('user_id', $session_id)->first();
    $skill = $this->skillModel->where('user_id', $session_id)->findAll();
    $competition = $this->competitionModel->where('user_id', $session_id)->findAll();

    $username = $user['username'];

    $data = [
      'title' => "$username | Agrifind",
      'user' => $user,
      'general' => $general,
      'skill' => $skill,
      'competition' => $competition
    ];

    return view('/profile/index', $data);
  }

  public function view($id)
  {
    //get user id from session
    $session_id = $this->session->get('id');

    if ($id == $session_id || $id == null) {
      return redirect()->to("/profile/index/$session_id");
    }

    //get user data from id
    $user = $this->profileModel->where('id', $id)->first();
    $general = $this->generalModel->where('user_id', $id)->first();
    $skill = $this->skillModel->where('user_id', $id)->findAll();
    $competition = $this->competitionModel->where('user_id', $id)->findAll();

    // $username = $user['username'];
    $firstname = explode(' ', $user['name'])[0];

    $data = [
      'title' => "$firstname's Profile | Agrifind",
      'user' => $user,
      'general' => $general,
      'skill' => $skill,
      'competition' => $competition
    ];

    return view("/profile/view", $data);
  }

  public function logout()
  {
    //terminate session
    $this->session->destroy();

    //redirect back to front page
    return redirect()->to('/login');
  }

  public function sendMessage($id)
  {
    //get user id from session
    $session_id = $this->session->get('id');

    // dd($id, $session_id, $this->request->getVar('subject'), $this->request->getVar('messageDescription'));

    $this->messageModel->save([
      'receiver_id' => $id,
      'sender_id' => $session_id,
      'subject' => $this->request->getVar('subject'),
      'message' => $this->request->getVar('messageDescription'),
    ]);

    return redirect()->to("/profile/view/$id");
  }
}
