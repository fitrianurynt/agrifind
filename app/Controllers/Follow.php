<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\GeneralModel;
use App\Models\CompetitionModel;
use App\Models\SkillModel;
use App\Models\MessageModel;
use App\Models\FollowModel;

class Follow extends BaseController
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

    //get all id that the user follow
    $follow = $this->followModel->where('follower_id', $session_id)->select('following_id')->findAll();

    //get following user its name and avatar

    if ($follow) {
      foreach ($follow as $f) {
        $f = $f['following_id'];
        $query = $this->profileModel->where('id', $f)->select('name, avatar, availability')->first();

        $following[] = [
          'id' => $f,
          'name' => $query['name'],
          'avatar' => $query['avatar'],
          'availability' => $query['availability']
        ];
      }
      usort($following, function ($a, $b) {
        return $a['name'] <=> $b['name'];
      });
    } else {
      $following = [];
    }


    //sort name alphabetically


    $data = [
      'title' => "Follow | Agrifind",
      'following' => $following,

    ];

    return view('/follow/index', $data);
  }

  public function follower()
  {
    //get user id from session
    $session_id = $this->session->get('id');

    //get all id that the user follow
    $follow = $this->followModel->where('following_id', $session_id)->select('follower_id')->findAll();

    //get following user its name and avatar
    if ($follow) {
      foreach ($follow as $f) {
        $f = $f['follower_id'];
        $query = $this->profileModel->where('id', $f)->select('name, avatar, availability')->first();

        $follower[] = ['id' => $f, 'name' => $query['name'], 'avatar' => $query['avatar'], 'availability' => $query['availability']];
      }

      usort($follower, function ($a, $b) {
        return $a['name'] <=> $b['name'];
      });

    } else {
      $follower = [];
    }

    $data = [
      'title' => "Follow | Agrifind",
      'follower' => $follower,

    ];

    return view('/follow/follower', $data);
  }
}
