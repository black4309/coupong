<?php

namespace App\Http\Controllers;

use App\Model\MainQueryBuilder;
use Illuminate\Http\Request;
use Session;

class MainController extends Controller
{

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
      $userID = $results[0]->ID;

      if($userID == "admin")
        $check = 1;
      else
        $check = 2;
    }

    return view('pages.login_check',
              [
               'check' => $check
              ]
            );
  }
}

?>
