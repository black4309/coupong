@include('layout.include')
@include('layout.header')

<script>




</script>

<div id="chart">
</div>

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


        /*
      var chart = c3.generate({
          bindto: '#chart',
          data:{
              json:{
                  'GROUP_NAME': ['20171101', '20171102', '20171103'],
                  '사용횟수' : [30, 200, 100]
              },
              x: 'GROUP_NAME',
              type: 'line',
              types:{
                  사용횟수: 'bar',
              }
          },
          grid: {
              x: {
                  show: true
              },
              y: {
                  show: true
              }
          }
      });
      */

    }

      $(document).ready(function(){

        var stat_data = requestService("/stat_data");


        chartLoad(stat_data);
      });

    </script>



</body>



</body>
</html>
