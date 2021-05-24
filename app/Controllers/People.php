<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class People extends BaseController
{
  public function __construct()
  {
    $this->peopleModel = new ProfileModel();
  }

  public function index()
  {
    $user = $this->peopleModel->select('id, name, department, nim, avatar, availability')->findAll();

    $data = [
      'title' => "People | Agrifind",
      'user' => $user
    ];

    return view('/people/index', $data);
  }

  
}
