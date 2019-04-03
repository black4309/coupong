@include('layout.header')


<br/>

@php

// 랜덤 쿠폰 생성
function generateCouponCode($prefix, $length = 13) {
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




// 랜덤 쿠폰 생성
echo generateCouponCode("HLO");

@endphp

<br/>
<center>

  <div class="input-group mb-3" style="width:20%">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">Prefix (3자리)</span>
    </div>
    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    <button type="button" class="btn btn-secondary">발행</button>
  </div>

</center>

</body>
</html>
