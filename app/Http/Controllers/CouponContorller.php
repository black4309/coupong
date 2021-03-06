<?php

namespace App\Http\Controllers;

use App\Model\CouponQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;

class CouponContorller extends Controller
{

  //쿠폰발행
  public function publish()
  {
      return view('pages.publish');
  }

// 생성된 쿠폰을 DB 입력
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



//쿠폰 리스트 출력
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

//쿠폰 중복검사
  public function checkCoupon(Request $request)
  {
      $code = $request->input('code');
      $checkString = "";

      $couponQueryBuilder = new CouponQueryBuilder();
      $existResults = $couponQueryBuilder->isExistCoupon($code);

      // 쿠폰 식별
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


// 통계
  public function stat()
  {
      $couponQueryBuilder = new CouponQueryBuilder();
      $statResults = $couponQueryBuilder->useStat();

      return view('pages.stat',
                [
                 'statResults' => $statResults
                ]
              );
  }

 // 통계 데이터
  public function stat_data()
  {
      $couponQueryBuilder = new CouponQueryBuilder();
      $statResults = $couponQueryBuilder->useStat();

      return view('pages.stat_data',
                [
                 'statResults' => $statResults
                ]
              );


      //return view('pages.stat_data')->with('data', json_encode($statResults));
  }


  public function test()
  {
      return view('pages.test');
  }
}

?>
