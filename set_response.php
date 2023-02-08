<?

if($_POST){

    $regions = [
      "м.Київ"=>'ua-kc',
      "м.Севастопіль"=>'ua-sc',
      "Івано-Франківська область"=>'ua-if',
      "АР Крим"=>'ua-kr',
      "Вінницька область"=>'ua-vi',
      "Волинська область"=>'ua-vo',
      "Дніпропетровська область"=>'ua-dp',
      "Донецька область"=>'ua-dt',
      "Житомирська область"=>'ua-zt',
      "Закарпатська область"=>'ua-zk',
      "Запорізька область"=>'ua-zp',
      "Кіровоградська область"=>'ua-kh',
      "Київська область"=>'ua-kv',
      "Луганська область"=>'ua-lh',
      "Львівська область"=>'ua-lv',
      "Миколаївська область"=>'ua-mk',
      "Одеська область"=>'ua-my',
      "Полтавська область"=>'ua-pl',
      "Рівненська область"=>'ua-rv',
      "Сумська область"=>'ua-sm',
      "Тернопільська область"=>'ua-tp',
      "Харківська область"=>'ua-kk',
      "Херсонська область"=>'ua-ks',
      "Хмельницька область"=>'ua-km',
      "Черкаська область"=>'ua-ck',
      "Чернівецька область"=>'ua-cv',
      "Чернігівська область"=>'ua-ch',
    ];
    $genders = ["Українка"=>'female', "Українець"=>'male'];

    //$post = json_decode($_GET);
    $post = $_POST;
    if(isset($post['countBasa']) && isset($post['countZhurba']) && isset($post['region']) && isset($post['gender'])){
        
        $countBasa = (int)$post['countBasa'];
        $countZhurba = (int)$post['countZhurba'];
        $region = '';
        $gender = '';

        if(isset($regions[$post['region']])){
          $region = $regions[$post['region']];
        }
        
        /*if(isset($genders[$post['gender']])){
          $gender = $genders[$post['gender']];
        }*/
        if($region && $gender){
            require __DIR__ . '/db.php';
            $db = new Db();
            $db->query("INSERT INTO articles SET countBasa=".$countBasa.", countZhurba=".$countZhurba.", region='".$region
            //."', gender='".$gender
            ."'");
            $result = ['success'=>1];
            echo json_encode($result);
            return;
        }
    }
    $result = ['error'=>1];
    echo json_encode($result);
    return;
}
?>