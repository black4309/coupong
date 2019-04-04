@include('layout.include')
@include('layout.header')



<script>

function check()
{
  var code = $("#coupon-input").val();

  if(code.length != 19)
  {
    alert('쿠폰번호 19자리를 입력하세요');
    return;
  }

  var ret = requestService("/check?code=" + code, );
  alert(ret);
}


// 페이지 시작 시, 자동 실행
$(document).ready(function(){

    $('#coupon-input').keydown(function(evt){
      if((evt.keyCode) && (evt.keyCode==13)) {
        check();
      }
    });
    
  });

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
