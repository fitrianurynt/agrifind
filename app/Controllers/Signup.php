<?php

namespace App\Controllers;

use App\Models\SignupModel;
use App\Models\GeneralModel;
use App\Models\CompetitionModel;
use App\Models\SkillModel;

class SignUp extends BaseController
{
  protected $signupModel;
  protected $generalModel;
  protected $competitionModel;
  protected $skillModel;

  public function __construct()
  {
    $this->signupModel = new SignupModel();
    $this->generalModel = new GeneralModel();
    $this->competitionModel = new CompetitionModel();
    $this->skillModel = new SkillModel();
  }

  public function index()
  {
    // check session if user is logged in
    if (!isset($_SESSION['id'])) {
      $data = [
        'title' => 'Sign Up | Agrifind',
        'validation' => \Config\Services::validation()
      ];

      return view('/signup/index', $data);
    } else {
      $id = $_SESSION['id'];
      return redirect()->to("/profile/index/$id");
    }
  }

  public function createAccount()
  {
    //input validation
    if (!$this->validate([
      'name' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Name is required',
        ]
      ],
      'username' => [
        'rules' => 'required|is_unique[user.username]',
        'errors' => [
          'required' => 'Username is required',
          'is_unique' => 'Username is taken'
        ]
      ],
      'email' => [
        'rules' => 'required|is_unique[user.email]|valid_email',
        'errors' => [
          'required' => 'Email is required',
          'is_unique' => 'Email is taken',
          'valid_email' => 'Email is invalid'
        ]
      ],
      'nim' => [
        'rules' => 'required|is_unique[user.nim]',
        'errors' => [
          'required' => 'NIM is required',
          'is_unique' => 'NIM is taken'
        ]
      ],
      'department' => [
        'rules' => 'required|differs[hiddenDept]',
        'errors' => [
          'required' => 'Department is required',
          'differs' => 'Department is required'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password is required',
        ]
      ],
      'passconf' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Confirm your password!',
          'matches' => "Your password doesn't match"
        ]
      ],

    ])) {
      return redirect()->to('/signup')->withInput();
    }

    //password hashing
    $password = $this->request->getVar('password');
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //first letter capital name
    $name = strtolower($this->request->getVar('name'));
    $name = ucwords($name);

    // save to database user
    $this->signupModel->save([
      'name' => $name,
      'username' => $this->request->getVar('username'),
      'email' => $this->request->getVar('email'),
      'nim' => strtoupper($this->request->getVar('nim')),
      'department' => $this->request->getVar('department'),
      'avatar' => 'default.jpg',
      'header' => 'default.jpg',
      'cv' => '',
      'availability' => 1,
      'password' => $hash
    ]);

    //getting newly made user's id
    $username = $this->request->getVar('username');
    $user = $this->signupModel->where('username', $username)->first();

    $id = $user['id'];

    //create new storage in table general for new id
    $this->generalModel->save([
      'about_me' => ''
    ]);
    // //create new storage in table general for new id


    //set session
    $session = \Config\Services::session();
    $session->set(['id' => $id]);

    return redirect()->to("/profile/index/$id");
  }
}
