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

  public function __construct()
  {
    $this->profileModel = new ProfileModel();
    $this->generalModel = new GeneralModel();
    $this->competitionModel = new CompetitionModel();
    $this->skillModel = new SkillModel();
    $this->messageModel = new MessageModel();
  }

  public function index($id = NULL)
  {
    //set session
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    if ($id == $session_id || $id == NULL) {
      $user = $this->profileModel->where('id', $session_id)->first();
      $general = $this->generalModel->where('user_id', $session_id)->first();
      $skill = $this->skillModel->where('user_id', $session_id)->findAll();
      $competition = $this->competitionModel->where('user_id', $session_id)->findAll();
    } else {
      return redirect()->to("/profile/index/$id");
    }

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
    //set session
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    // dd($session_id, $id, $id == null);

    if ($id == $session_id) {
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
    $session = \Config\Services::session();
    $session->destroy();

    //redirect back to front page
    return redirect()->to('/home/index');
  }

  public function setting($type, $id)
  {
    //set session
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    if ($id == $session_id) {
      $user = $this->profileModel->where('id', $session_id)->first();
    } else {
      return redirect()->to("/profile/index/$session_id");
    }

    //get data from database for $data
    $general = $this->generalModel->where('user_id', $id)->first();
    $username = $user['username'];

    $skill = $this->skillModel->where('user_id', $id)->findAll();
    $competition = $this->competitionModel->where('user_id', $id)->findAll();

    //send to setting page
    $data = [
      'title' => "Setting $username | Agrifind",
      'user' => $user,
      'general' => $general,
      'skill' => $skill,
      'competition' => $competition,
      'validation' => \Config\Services::validation()
    ];

    if ($type == 'general') {
      return view('/profile/general', $data);
    } else if ($type == 'account') {
      return view('/profile/account', $data);
    } else if ($type == 'skill') {
      return view('/profile/skill', $data);
    } else if ($type == 'delete') {
      return view('/profile/delete', $data);
    } else {
      return view('/profile/general', $data);
    }
  }

  public function editGeneral($id)
  {
    //validation for image upload
    if (!$this->validate([
      'avatar' => [
        'rules' => 'max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'File size too large (max: 1MB)',
          'is_image' => 'Only .jpg, .jpeg, .png format!',
          'mime_in' => 'Only .jpg, .jpeg, .png format!'
        ]
      ],
      'header' => [
        'rules' => 'max_size[header,4096]|is_image[header]|mime_in[header,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'File size too large (max: 4MB)',
          'is_image' => 'Only .jpg, .jpeg, .png format!',
          'mime_in' => 'Only .jpg, .jpeg, .png format!'
        ]
      ],
      'cv' => [
        'rules' => 'max_size[cv,4096]|mime_in[cv,application/pdf]',
        'errors' => [
          'max_size' => 'File size too large (max: 4MB)',
          'mime_in' => 'Only .pdf format!'
        ]
      ]
    ])) {
      return redirect()->to("/profile/setting/general/$id")->withInput();
    }

    //if department and name doesnt change (bcoz of disabled selected)
    $department = $this->request->getVar('department');
    if ($department == NULL) $department = $this->request->getVar('hiddenDept');

    $name = $this->request->getVar('name');
    if ($name == "") $name = $this->request->getVar('hiddenName');

    $name = $this->request->getVar('name');
    if ($name == "") $name = $this->request->getVar('hiddenName');

    $avatar = $this->request->getFile('avatar');
    $header = $this->request->getFile('header');
    $cv = $this->request->getFile('cv');

    //profile pic
    if ($avatar->getError() == 4) {
      $avatarName = $this->request->getVar('hiddenAvatar');
    } else {
      //generate nama sampul random
      $avatarName = $avatar->getRandomName();
      //pindahkan file ke folder img
      $avatar->move('img/profile', $avatarName);
      //remove old pic
      $oldAvatar = $this->request->getVar('hiddenAvatar');
      if ($oldAvatar != 'default.jpg')
        unlink('img/profile/' . $oldAvatar);
    }

    //header
    if ($header->getError() == 4) {
      $headerName = $this->request->getVar('hiddenHeader');
    } else {
      //generate nama sampul random
      $headerName = $header->getRandomName();
      //pindahkan file ke folder img
      $header->move('img/header', $headerName);
      //remove old pic
      $oldHeader = $this->request->getVar('hiddenHeader');
      if ($oldHeader != 'default.jpg')
        unlink('img/header/' . $oldHeader);
    }

    $user = $this->profileModel->where('id', $id)->first();

    //cv
    if ($cv->getError() == 4) {
      $cvName = $this->request->getVar('hiddenCV');
    } else {

      $oldCV = $this->request->getVar('hiddenCV');
      if ($oldCV != '') {
        unlink('docs/cv/' . $oldCV);
      }


      //generate nama sampul random
      $cvName = $user['name'] . " " . $user['username'] . ".pdf";
      //pindahkan file ke folder img
      $cv->move('docs/cv', $cvName);
      //remove old pic

    }


    //updated data
    $this->profileModel->save([
      'id' => $id,
      'name' => $this->request->getVar('name'),
      'email' => $this->request->getVar('email'),
      'nim' => $this->request->getVar('nim'),
      'avatar' => $avatarName,
      'header' => $headerName,
      'cv' => $cvName,
      'availability' => $this->request->getVar('availability'),
      'department' => $department
    ]);

    //dd($this->request->getVar('about_me'));
    //update general data
    $this->generalModel->set([
      'about_me' => $this->request->getVar('about_me'),
      'phone' => $this->request->getVar('phone'),
      'experience' => $this->request->getVar('experience'),
      'profession' => $this->request->getVar('profession')
    ])->where('user_id', $id)->update();

    return redirect()->to('/profile');
  }

  public function removeProfilePicture()
  {
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    $this->profileModel->save([
      'id' => $session_id,
      'avatar' => 'default.jpg'
    ]);

    return redirect()->to("/profile/setting/general/$session_id")->withInput();
  }

  public function removeHeader()
  {
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    $this->profileModel->save([
      'id' => $session_id,
      'header' => 'default.jpg'
    ]);

    return redirect()->to("/profile/setting/general/$session_id")->withInput();
  }

  public function removeCV()
  {
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    $this->profileModel->save([
      'id' => $session_id,
      'cv' => ''
    ]);

    return redirect()->to("/profile/setting/general/$session_id")->withInput();
  }

  public function deleteAccount($id)
  {
    //set session
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

    if ($id == $session_id) {
      $user = $this->profileModel->where('id', $session_id)->first();
    } else {
      return redirect()->to("/profile/index/$session_id");
    }

    $profile = $this->profileModel->where('id', $id)->delete();
    $general = $this->generalModel->where('user_id', $id)->delete();
    $competition = $this->competitionModel->where('user_id', $id)->delete();

    return redirect()->to('/profile/logout');
  }

  public function addSkill($id)
  {
    $this->skillModel->save([
      'user_id' => $this->request->getVar('hiddenUserId'),
      'name' => $this->request->getVar('nameSkill'),
      'level' => $this->request->getVar('levelSkill'),
      'description' => $this->request->getVar('descriptionSkill'),
    ]);

    return redirect()->to("/profile/setting/skill/$id");
  }

  public function deleteSkill($id, $user_id)
  {
    $this->skillModel->where('skill_id', $id)->delete();
    return redirect()->to("/profile/setting/skill/$user_id");
  }

  public function addCompetition($id)
  {
    $this->competitionModel->save([
      'user_id' => $this->request->getVar('hiddenUserId'),
      'name' => $this->request->getVar('nameComp'),
      'rank' => $this->request->getVar('rankComp'),
      'organiser' => $this->request->getVar('organiserComp'),
      'field' => $this->request->getVar('fieldComp'),
      'description' => $this->request->getVar('descriptionComp'),
    ]);

    return redirect()->to("/profile/setting/skill/$id");
  }

  public function deleteCompetition($id, $user_id)
  {
    $this->competitionModel->where('competition_id', $id)->delete();
    return redirect()->to("/profile/setting/skill/$user_id");
  }

  public function sendMessage($id)
  {
    //set session
    $session = \Config\Services::session();

    //get user id from session
    $session_id = $session->get('id');

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
