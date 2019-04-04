@include('layout.include')

<script>
function check()
{
  var id = $("#user-id").val();
  var password = $("#user-password").val();

  if(id.length == 0 || password.length ==0)
  {
    alert('아이디 혹은 패스워드를 입력하세요');
    return;
  }

  var ret = requestService("/login_check?id=" + id + "&password=" + password, );

  if(ret == 0)
    alert('로그인이 실패했습니다');
  else
    window.location.href = "/main";
}






  // 페이지 시작 시, 자동 실행
  $(document).ready(function(){

      $('#user-id').keydown(function(evt){
    		if((evt.keyCode) && (evt.keyCode==13)) {
    			check();
    		}
    	});

      $('#user-password').keydown(function(evt){
    		if((evt.keyCode) && (evt.keyCode==13)) {
    			check();
    		}
    	});

  });




</script>


<br/><br/><br/><br/>
<center>
  <div class="wrapper" style="width:20%">
    <form class="form-signin">
      <input type="text" class="form-control" id="user-id" placeholder="아이디" required="" autofocus="" />
      <input type="password" class="form-control" id="user-password" placeholder="패스워드" required=""/>
      <br/>
      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="check()">로그인</button>
    </form>
  </div>
</center>

</body>
</html>
