@include('layout.include')
@include('layout.header')

<script>

  function paging(id)
  {
    var page_number = $(id).val();
    window.location.href = "/list?page=" + page_number;
  }

  function search()
  {
    var search = $("#group-search").val();
    window.location.href = "/list?group=" + search;
  }

  function allSearch()
  {
    window.location.href = "/list"; // 리다이렉트
  }

</script>

<div class="input-group mb-3" style="width:20%">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">그룹 검색</span>
  </div>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="group-search">&nbsp;
  <button type="button" class="btn btn-secondary" onclick="search()">검색</button>&nbsp;
  <button type="button" class="btn btn-secondary" onclick="allSearch()">전체보기</button>
</div>

<br/>

@for ($i = 1; $i <= 10; $i++)
  <input type="button" class="btn btn-primary btn-sm" value="{{$i}}" onclick="paging(this)"></input>
@endfor

<br/><br/>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">그룹명</th>
      <th scope="col">코드</th>
      <th scope="col">사용 일시</th>
      <th scope="col">사용 유저</th>
    </tr>
  </thead>
  <tbody>
    @foreach($couponListResults as $couponListResult)
    <tr>
      <td>{{$couponListResult->COUPON_GROUP_NAME}}</td>
      <td>{{$couponListResult->COUPON_CODE}}</td>
      <td>{{$couponListResult->USE_DATETIME}}</td>
      <td>{{$couponListResult->NAME}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

</body>
</html>
