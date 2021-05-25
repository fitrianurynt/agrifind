<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
  protected $signupModel;

  public function __construct()
  {
    $this->loginModel = new LoginModel();
  }

  public function index()
  {
    // check session if user is logged in
    if (!isset($_SESSION['id'])) {
      $data = [
        'title' => 'Sign Up | Agrifind',
        'fail' => false
      ];

      return view('/login/index', $data);
    } else {
      $id = $_SESSION['id'];
      return redirect()->to("/profile/index/$id");
    }
  }

  public function loginAccount()
  {
    //get user data from login form
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    //match user data from db
    $user = $this->loginModel->where('username', $username)->first();

    //check if username available or pass is wrong
    if ($user == NULL || !password_verify($password, $user['password'])) {
      $data = [
        'title' => 'Sign Up | Agrifind',
        'fail' => true
      ];

      return view('/login/index', $data);
    }

    $id = $user['id'];

    //set session
    $session = \Config\Services::session();
    $session->set(['id' => $id]);
    $session->set(['avatar' => $user['avatar']]);
    $session->set(['username' => $user['username']]);

    return redirect()->to("/profile/index/$id");
  }
}
