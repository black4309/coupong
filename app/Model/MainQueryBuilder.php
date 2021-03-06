<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;

class MainQueryBuilder
{

// 아이디 & 패스워드 체크
    public function checklogin($id, $password)
    {
      $password = hash('sha512', $password);

      $query =
      "
      SELECT MEMBER_UID, ID, NAME
      FROM MEMBER
      WHERE ID=:ID
      AND PASSWORD=:PASSWORD
      ";

      $result = DB::select($query, ['ID' => $id, 'PASSWORD' => $password]);
      return $result;
    }
}

?>
