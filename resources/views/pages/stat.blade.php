@include('layout.include')
@include('layout.header')

<script>




</script>

<div id="chart">
</div>

<br/><br/>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">그룹명</th>
      <th scope="col">쿠폰사용수</th>
    </tr>
  </thead>
  <tbody>
    @foreach($statResults as $statResult)
    <tr>
      <td>{{$statResult->COUPON_GROUP}}</td>
      <td>{{$statResult->USE_COUNT}}</td>
    </tr>
    @endforeach
  </tbody>
</table>


    <script>

    //var jbAry = [ 'GROUP_32VDO', 'GROUP_67XNG', 'GROUP_NJP3W', 'GROUP_P2006'];
    c3KeyArray = new Array;

    @foreach($statResults as $statResult)
      c3KeyArray.push('{{$statResult->COUPON_GROUP}}');
    @endforeach

    function chartLoad(stat_data)
    {
        console.log(stat_data);


        var chart = c3.generate({
            bindto: '#chart',
            data: {
            url: "/stat_data",
            mimeType: 'json',
            type: 'bar',
            keys: {
//                x: 'name', // it's possible to specify 'x' when category axis
                value: c3KeyArray
            }
          },
          axis: {
              x: {
  //                type: 'category'
              }
          }
        });
    }

      $(document).ready(function(){

        var stat_data = requestService("/stat_data");


        chartLoad(stat_data);
      });

    </script>



</body>



</body>
</html>
