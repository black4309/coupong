<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MainQueryBuilder
{
    public function selectHuman()
    {
      $query =
      "
      SELECT NAME, AGE FROM HUMAN
      ";

      $result = DB::select($query);
      return $result;
    }


}

?>
