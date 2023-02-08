<?
$data = [
    'ua-my'=> 0, 'ua-ks'=> 0, 'ua-kc'=> 0, 'ua-zt'=> 0,
    'ua-sm'=> 0, 'ua-dt'=> 0, 'ua-dp'=> 0, 'ua-kk'=> 0,
    'ua-lh'=> 0, 'ua-pl'=> 0, 'ua-zp'=> 0, 'ua-sc'=> 0,
    'ua-kr'=> 0, 'ua-ch'=> 0, 'ua-rv'=> 0, 'ua-cv'=> 0,
    'ua-if'=> 0, 'ua-km'=> 0, 'ua-lv'=> 0, 'ua-tp'=> 0,
    'ua-zk'=> 0, 'ua-vo'=> 0, 'ua-ck'=> 0, 'ua-kh'=> 0,
    'ua-kv'=> 0, 'ua-mk'=> 0, 'ua-vi'=> 0
];

//require __DIR__ . '/db.php';

//$db = new Db();
$regions = $db->query("SELECT region, COUNT(*) as count FROM articles GROUP BY region");
$string = '[]';
if($regions->rows){
    foreach($regions->rows as $row){
        $data[$row['region']] = $row['count'];
    }
    $string = '[';
    $count = 0;
    foreach($data as $key=>$value){
        $count++;
        $string .= "['".$key."', ".$value."]";
        if(count($data) != $count)$string .= ",";
    }
    $string .= ']';

}

/*echo "<pre>";
print_r(json_encode($data));
echo "</pre>";*/
//<?php echo '["' . implode('", "', $sampleArray) . '"]' ?>;

?>
<div class="map-box">
  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>

  <div id="container"></div>
  <script>
   (async () => {

    const topology = await fetch(
        'https://code.highcharts.com/mapdata/countries/ua/ua-all.topo.json'
    ).then(response => response.json());

    // Prepare demo data. The data is joined to map using value of 'hc-key'
    // property by default. See API docs for 'joinBy' for more info on linking
    // data and map.
    /*const data = [
        ['ua-my', 10], ['ua-ks', 11], ['ua-kc', 12], ['ua-zt', 13],
        ['ua-sm', 14], ['ua-dt', 15], ['ua-dp', 16], ['ua-kk', 17],
        ['ua-lh', 18], ['ua-pl', 19], ['ua-zp', 20], ['ua-sc', 21],
        ['ua-kr', 22], ['ua-ch', 23], ['ua-rv', 24], ['ua-cv', 25],
        ['ua-if', 26], ['ua-km', 27], ['ua-lv', 28], ['ua-tp', 29],
        ['ua-zk', 30], ['ua-vo', 31], ['ua-ck', 32], ['ua-kh', 33],
        ['ua-kv', 34], ['ua-mk', 35], ['ua-vi', 36]
    ];*/
    const data = <?echo $string ?>;

    // Create the chart
    Highcharts.mapChart('container', {
      chart: {
          map: topology
      },
      title: {
          text: 'Наші герої'
      },
      mapNavigation: {
          enabled: true,
          buttonOptions: {
              verticalAlign: 'bottom'
          }
      },
      colorAxis: {
          min: 0
      },

      series: [{
          data: data,
          //name: 'Random data',
          name: '',
          states: {
              hover: {
                  color: '#fff'
              }
          },
          dataLabels: {
              enabled: true,
              //format: '{point.name}',
              format: '{point.value}'
              //format: '{point[1]}'
          }
      }]
  });

  })();
  </script>

</div>