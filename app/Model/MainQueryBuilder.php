<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;

class MainQueryBuilder
{
    public function checklogin($id, $password)
    {
      Log::info("ID : ".$id);
      Log::info("PASSWORD : ".$password);

      $query =
      "
      SELECT ID, NAME
      FROM MEMBER
      WHERE ID=:ID
      AND PASSWORD=:PASSWORD
      ";

      $result = DB::select($query, ['ID' => $id, 'PASSWORD' => $password]);
      return $result;
    }
}

?>
