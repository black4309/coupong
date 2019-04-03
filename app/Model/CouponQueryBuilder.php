<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CouponQueryBuilder
{

  //쿠폰 리스트 
    public function selectCouponList($group)
    {
      $query =
      "
      SELECT
      CG.COUPON_GROUP_NAME
      ,C.COUPON_CODE
      ,IFNULL(C.USE_DATETIME, '해당없음') USE_DATETIME
      ,IFNULL(M.NAME, '해당없음') NAME
      FROM
      COUPON_GROUP CG
      ,MEMBER M
      RIGHT OUTER JOIN COUPON C
      ON M.MEMBER_UID=C.MEMBER_UID
      WHERE C.COUPON_GROUP_UID=CG.COUPON_GROUP_UID
      ";

      if($group != null)
      {
        $query .= "AND CG.COUPON_GROUP_NAME='".$group."'";
      }

      $result = DB::select($query);
      return $result;

    }

// 쿠폰 사용여부
    public function checkCoupon($code)
    {
      $query =
      "
      SELECT COUNT(*) COUNT
      FROM COUPON
      WHERE COUPON_CODE=:CODE
      AND IS_USE=1
      ";

      $result = DB::select($query, ['CODE' => $code]);
      return $result;
    }

// 쿠폰 사용
    public function useCoupon($code)
    {
      $query =
      "
      UPDATE COUPON
      SET
      USE_DATETIME=CURRENT_TIMESTAMP
      ,MEMBER_UID=2
      WHERE COUPON_CODE=?
      ";

      DB::insert($query, [$code]);
    }


}

?>
