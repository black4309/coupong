<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; //로그
use Session;

class CouponQueryBuilder
{

// 쿠폰 난수 발생
    public function generateCouponCode($prefix, $length = 13) {

        $prefix = strtoupper($prefix);
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $code = $prefix.$randomString;
        $code = substr($code, 0, 4)."-".substr($code, 4, 4)."-".substr($code, 8, 4)."-".substr($code, 12, 4);

        return $code;
    }

    //**쿠폰 리스트
    public function selectCouponList($group, $page)
    {
      if($page == null)
        $page = 1;

      $limitNumber = $page * 100 - 100;
      $limitQuery = "LIMIT ".$limitNumber.",100";


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
      WHERE C.COUPON_GROUP_UID=CG.COUPON_GROUP_UID"
      ;

      if($group != null)
      {
        $query .= " AND CG.COUPON_GROUP_NAME='".$group."'";
      }
      $query .= " ".$limitQuery;

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

    // 쿠폰 존재 여부
    public function isExistCoupon($code)
    {
      Log::info("code : ".$code);

      $query =
      "
      SELECT COUNT(*) COUNT
      FROM COUPON
      WHERE COUPON_CODE=:CODE
      ";

      $result = DB::select($query, ['CODE' => $code]);
      return $result;
    }

// ** 쿠폰 생성
    public function publish_db($prefix)
    {

      $addQuery = "";
      $totalCount = 100000;
      for($i = 0; $i < $totalCount; $i++)
      {
        $code = $this->generateCouponCode($prefix);
        $addQuery .= "('".$code."', NULL, 0, 1)";

        if($i != $totalCount-1)
          $addQuery .= ",";
      }

      $query =
      "
      INSERT INTO COUPON
      (COUPON_CODE, USE_DATETIME, IS_USE, COUPON_GROUP_UID)
      VALUES
      ".$addQuery;

      DB::insert($query, [$code]);

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
