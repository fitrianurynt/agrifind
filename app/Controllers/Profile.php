<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\GeneralModel;
use App\Models\CompetitionModel;
use App\Models\SkillModel;
use App\Models\MessageModel;
use App\Models\FollowModel;

class Profile extends BaseController
{
  protected $profileModel;
  protected $generalModel;
  protected $competitionModel;
  protected $skillModel;
  protected $messageModel;
  protected $followModel;
  protected $session;

  public function __construct()
  {
    $this->profileModel = new ProfileModel();
    $this->generalModel = new GeneralModel();
    $this->competitionModel = new CompetitionModel();
    $this->skillModel = new SkillModel();
    $this->messageModel = new MessageModel();
    $this->followModel = new FollowModel();
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

    $competition_rank = ["1st", "2nd", "3rd", "Favorite", "Honorable Mention", "Participate", "Other"];
    foreach ($competition_rank as $c){
      $query = $this->competitionModel->where('user_id', $session_id)->where('rank', $c)->findAll();
      $rank[] = sizeof($query);
      
    }

    $username = $user['username'];

    $data = [
      'title' => "$username | Agrifind",
      'user' => $user,
      'general' => $general,
      'skill' => $skill,
      'competition' => $competition,
      'rank' => $rank
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
    $follower_id = ['follower_id' => $session_id, 'following_id' => $id];
    $follow = $this->followModel->where($follower_id)->first();

    $competition_rank = ["1st", "2nd", "3rd", "Favorite", "Honorable Mention", "Participate", "Other"];
    foreach ($competition_rank as $c){
      $query = $this->competitionModel->where('user_id', $id)->where('rank', $c)->findAll();
      $rank[] = sizeof($query);
    }

    // $username = $user['username'];
    $firstname = explode(' ', $user['name'])[0];

    $data = [
      'title' => "$firstname's Profile | Agrifind",
      'user' => $user,
      'general' => $general,
      'skill' => $skill,
      'competition' => $competition,
      'rank' => $rank,
      'follow' => $follow
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

  public function follow($id)
  {
    $session_id = $this->session->get('id');

    $this->followModel->save([
      'follower_id' => $session_id,
      'following_id' => $id
    ]);

    return redirect()->to("/profile/view/$id");
  }

  public function unfollow($id)
  {
    $session_id = $this->session->get('id');

    $follower_id = ['follower_id' => $session_id, 'following_id' => $id];
    //get user id from session

    // dd($id, $session_id, $this->request->getVar('subject'), $this->request->getVar('messageDescription'));

    $this->followModel->where($follower_id)->delete();

    return redirect()->to("/profile/view/$id");
  }
}
