<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<script type="text/javascript">

  function requestService(url, request_data)
  {
    var return_val = "";
    $.ajax({
      url:url,
      timeout:1000,
      async:false,
      data:'request_data',
      dataType:'html',
      success : function(data, status, xhr) {
        return_val = data;
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
        return false;
      }
    });

    return return_val;
  }

  function maxLengthCheck(object){
    if (object.value.length > object.maxLength){
      object.value = object.value.slice(0, object.maxLength);
    }
  }

</script>

<body>

<h2>쿠!퐁!</h2>

<br/>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/publish">쿠폰 발행</a>
      </li>

	  <li class="nav-item active">
        <a class="nav-link" href="/list">쿠폰 리스트</a>
      </li>

	  <li class="nav-item active">
        <a class="nav-link" href="/use">쿠폰 사용</a>
      </li>

	  <li class="nav-item active">
        <a class="nav-link" href="/stat">쿠폰 통계</a>
      </li>
    </ul>
  </div>
</nav>

<br/>
