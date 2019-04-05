<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.18/c3.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>
  <script src="https://d3js.org/d3.v3.min.js"></script>

</head>

<script type="text/javascript">

//쿠폰중복검사 (Ajax)
  function requestService(url, request_data)
  {
    var return_val = "";
    $.ajax({
      url:url,
      timeout:60000,
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


//javascript로 getparameter 가져오기 
  function Request(){
  	var requestParam ="";
          this.getParameter = function(param){
      	var url = unescape(location.href); //현재 주소를 decoding
          var paramArr = (url.substring(url.indexOf("?")+1,url.length)).split("&"); //파라미터만 자르고, 다시 &그분자를 잘라서 배열에 넣는다.

          for(var i = 0 ; i < paramArr.length ; i++){
              var temp = paramArr[i].split("="); //파라미터 변수명을 담음
              if(temp[0].toUpperCase() == param.toUpperCase()){
              	requestParam = paramArr[i].split("=")[1]; // 변수명과 일치할 경우 데이터 삽입
                  break;
              }
          }
          return requestParam;
      };
  }

  var request = new Request();

</script>

<body>
