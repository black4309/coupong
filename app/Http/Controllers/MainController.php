<?php

namespace App\Http\Controllers;

use App\Model\MainQueryBuilder;
use Illuminate\Http\Request;
use Session;

class MainController extends Controller
{
  public function index()
  {
      return view('home');
  }

  public function publish()
  {
      return view('pages.publish');
  }


  public function list()
  {
      $mainQueryBuilder = new MainQueryBuilder();
      $results = $mainQueryBuilder->selectHuman();

      return view('pages.list',
                [
                   'results' => $results
                ]
              );
  }

  public function use()
  {
      return view('pages.use');
  }

  public function stat()
  {
      return view('pages.stat');
  }


  public function test()
  {
      return view('pages.test');
  }
}

?>
