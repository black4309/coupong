@include('layout.include')
@include('layout.header')


<script>

function check()
{
  var ret = requestService("/list?code=10", );
  alert(ret);
}

</script>

<input type='button' value='중복 체크' onclick="check()">
