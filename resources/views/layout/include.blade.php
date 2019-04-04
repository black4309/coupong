<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<script type="text/javascript">

//쿠폰중복검사 (Ajax)
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

//쿠폰 자리수 체크 (19자리)
  function maxLengthCheck(object){
    if (object.value.length > object.maxLength){
      object.value = object.value.slice(0, object.maxLength);
    }
  }

</script>

<body>
