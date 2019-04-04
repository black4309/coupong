@include('layout.include')
@include('layout.header')

<script>
function publish()
{
  var prefix = $("#code-prefix").val();
  var ret = requestService("/publish_db?prefix=" + prefix);
  alert(ret);
}
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
