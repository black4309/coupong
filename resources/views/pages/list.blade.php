@include('layout.header')

<div class="input-group mb-3" style="width:20%">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">그룹 검색</span>
  </div>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
  <button type="button" class="btn btn-secondary">검색</button>
</div>

<br/>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">이름</th>
      <th scope="col">나이</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($results as $result)
    <tr>
      <td>{{$result->NAME}}</td>
      <td>{{$result->AGE}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<!--
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">코드</th>
      <th scope="col">사용 일시</th>
      <th scope="col">사용 유저</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
-->

</body>
</html>
