@include('layout.include')
@include('layout.header')

<script>


// 쿠폰 (Prefix) textbox 공백 체크 
function publish()
{
  var prefix = $("#code-prefix").val();

  if(prefix.length != 3)
  {
    alert('쿠폰 앞자리 3글자를 입력하세요');
    return;
  }

  var ret = requestService("/publish_db?prefix=" + prefix);
  alert(ret);
}


  // 페이지 시작 시, 자동 실행
  $(document).ready(function(){

      $('#code-prefix').keydown(function(evt){
    		if((evt.keyCode) && (evt.keyCode==13)) {
    			publish();
    		}
    	});


  });


</script>

<br/>

<br/>
<center>

  <div class="input-group mb-3" style="width:20%">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-default">Prefix (3자리)</span>
    </div>
    <input type="text" id="code-prefix" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="3" oninput="maxLengthCheck(this)">
    <button type="button" class="btn btn-secondary" onclick="publish()">발행</button>
  </div>

</center>

</body>
</html>
