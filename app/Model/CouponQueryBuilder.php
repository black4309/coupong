<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;

class CouponQueryBuilder
{

// 쿠폰 난수 발생
    public function generateCouponGroup($length = 5) {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return "GROUP_".$randomString;
    }

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

// ** 쿠폰 생성 및 랜덤 확률 지정
    public function publish_db($prefix)
    {
      // group 생성
      $query =
      "
      INSERT INTO COUPON_GROUP
      VALUES
      (NULL, ?)
      ";

      $groupName = $this->generateCouponGroup();

      DB::insert($query, [$groupName]);
      $groupUID = DB::getPdo()->lastInsertId();

      $addQuery = "";
      $totalCount = 100000;


      $query =
      "
      SELECT MEMBER_UID FROM MEMBER WHERE ID <> 'admin'
      ";
      $memberResult = DB::select($query);


      for($i = 0; $i < $totalCount; $i++)
      {
        $code = $this->generateCouponCode($prefix);
        $random = mt_rand(1, 5);

        if($random == 5) // 20% 확률로 사용됨
        {
          $randomMember = mt_rand(0, count($memberResult)-1);
          $memberUID = $memberResult[$randomMember]->MEMBER_UID;

          $addQuery .= "('".$code."', CURRENT_TIMESTAMP, 1, ".$groupUID.", ".$memberUID.")";
        }
        else
          $addQuery .= "('".$code."', NULL, 0, ".$groupUID.", NULL)";

        if($i != $totalCount-1)
          $addQuery .= ",";
      }

      $query =
      "
      INSERT INTO COUPON
      (COUPON_CODE, USE_DATETIME, IS_USE, COUPON_GROUP_UID, MEMBER_UID)
      VALUES
      ".$addQuery;

      DB::insert($query);
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

    public function useStat()
    {
      $query =
      "
      SELECT CG.COUPON_GROUP_NAME COUPON_GROUP, COUNT(CG.COUPON_GROUP_UID) USE_COUNT
      FROM
      COUPON C, COUPON_GROUP CG
      WHERE C.COUPON_GROUP_UID=CG.COUPON_GROUP_UID
      AND C.IS_USE=1
      GROUP BY CG.COUPON_GROUP_NAME, CG.COUPON_GROUP_UID
      ";

      $result = DB::select($query);
      return $result;
    }


}

?>
