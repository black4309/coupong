<?php

namespace App\Http\Controllers;

use App\Model\CouponQueryBuilder;
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


  public function list(Request $request)
  {
      $group = $request->input('group');

      $couponQueryBuilder = new   CouponQueryBuilder();
      $couponListResults = $couponQueryBuilder->selectCouponList($group);

      return view('pages.list',
                [
                 'couponListResults' => $couponListResults
                ]
              );
  }

  public function checkCoupon(Request $request)
  {
      $code = $request->input('code');

      $couponQueryBuilder = new CouponQueryBuilder();
      $checkResults = $couponQueryBuilder->checkCoupon($code);

      $checkString = "중복되지 않았습니다.";
      if($checkResults[0]->COUNT == 1)
      {
        $checkString = "중복되었습니다.";
      }
      else
      {
        $couponQueryBuilder->useCoupon($code);
      }

      return view('pages.check',
                [
                 'checkString' => $checkString
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
