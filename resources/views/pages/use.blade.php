@include('layout.header')


<script>

function check()
{
  var code = $("#coupon-input").val();
  var ret = requestService("/check?code=" + code, );
  alert(ret);
}

</script>



<center>

  <div class="input-group mb-3" style="width:20%">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">쿠폰 번호</span>
    </div>
    <input type="text" class="form-control" aria-label="Sizing example input" id="coupon-input"
    aria-describedby="inputGroup-sizing-default" maxlength="19"
    oninput="maxLengthCheck(this)">
    <button type="button" class="btn btn-secondary" onclick="check()">사용</button>
  </div>

</center>

</body>
</html>
