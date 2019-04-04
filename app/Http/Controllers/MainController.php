<?php

namespace App\Http\Controllers;

use App\Model\MainQueryBuilder;
use Illuminate\Http\Request;
use Session;

class MainController extends Controller
{
  public function index()
  {
      $isLogin = Session::get('session_isLogin');

      $page = "pages.login";
      if($isLogin == 1)
        return view('pages.main');

      return view($page);
  }

  public function login()
  {
      return view('pages.login');
  }

  public function main()
  {
      return view('pages.main');
  }

  public function login_check(Request $request)
  {
    $check = 0;

    $id = $request->input('id');
    $password = $request->input('password');

    $mainQueryBuilder = new MainQueryBuilder();
    $results = $mainQueryBuilder->checklogin($id, $password);

    if(count($results) == 1)
    {
      $check = 1;

      Session::put('session_isLogin', "1");
      Session::put('session_userid', $results[0]->ID);
      Session::put('session_username', $results[0]->NAME);
    }

    return view('pages.login_check',
              [
               'check' => $check
              ]
            );
  }
}

?>
