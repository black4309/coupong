<?php

namespace App\Http\Controllers;

use App\Model\CouponQueryBuilder;
use Illuminate\Http\Request;
use Session;

class CouponContorller extends Controller
{
  public function publish()
  {
      return view('pages.publish');
  }


  public function get_time() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
  }


  public function publish_db(Request $request)
  {
    $prefix = $request->input('prefix');
    $couponQueryBuilder = new   CouponQueryBuilder();


    $publish_dbResults = $couponQueryBuilder->publish_db($prefix);




    $check = "발행 성공";
    return view('pages.publish_db',
              [
               'check' => $check
              ]
            );

  }



//리스트 출력
  public function list(Request $request)
  {
      $group = $request->input('group');
      $page = $request->input('page');

      $couponQueryBuilder = new   CouponQueryBuilder();
      $couponListResults = $couponQueryBuilder->selectCouponList($group, $page);

      return view('pages.list',
                [
                 'couponListResults' => $couponListResults
                ]
              );
  }

//쿠폰중복검사
  public function checkCoupon(Request $request)
  {
      $code = $request->input('code');
      $checkString = "";

      $couponQueryBuilder = new CouponQueryBuilder();
      $existResults = $couponQueryBuilder->isExistCoupon($code);

      if($existResults[0]->COUNT == 0)
      {
          $checkString = "쿠폰이 존재하지 않습니다.";
      }
      else
      {
          $checkResults = $couponQueryBuilder->checkCoupon($code);

          if($checkResults[0]->COUNT == 1)
          {
            $checkString = "이미 사용되었습니다.";
          }
          else
          {
            $checkString = "쿠폰을 정상적으로 사용했습니다.";
            $couponQueryBuilder->useCoupon($code);
          }
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
