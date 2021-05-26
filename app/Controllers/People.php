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
    // $user = $this->peopleModel->select('id, name, department, nim, avatar, availability')->orderBy('name ASC')->findAll();
  
    

    $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1 ;

    $keyword = $this->request->getVar('keyword');

    if($keyword || $keyword!=null){
      $people = $this->peopleModel->select('id, name, department, nim, avatar, batch, availability')->orderBy('availability ASC, name ASC')->search($keyword);

    } else {
      $people = $this->peopleModel->select('id, name, department, nim, avatar, batch, availability')->orderBy('availability ASC, name ASC');
    }

    // d($people);


    // $user = $this->peopleModel->select('id, name, department, nim, avatar, availability')->orderBy('name ASC')->paginate(2, 'user');

    $data = [
      'title' => "People | Agrifind",
      'user' => $people->paginate(25, 'user'),
      'pager' => $this->peopleModel->pager,
      'currentPage' => $currentPage,
      'keyword' => $keyword
    ];

    return view('/people/index', $data);
  }

  
}
