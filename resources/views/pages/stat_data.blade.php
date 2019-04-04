[
{
@php
  for($i = 0; $i < count($statResults); $i++)
  {

    echo "\"".$statResults[$i]->COUPON_GROUP."\""." : ".$statResults[$i]->USE_COUNT;

    if($i < count($statResults) - 1)
      echo ",";
  }
@endphp
}
]
