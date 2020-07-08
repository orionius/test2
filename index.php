




<?php


/***********    задание номер 1  *****************/
echo "
 SELECT u.name,count(phone)
FROM phone_numbers p
FULL JOIN users u ON u.id = p.user_id
WHERE (u.birth_date BETWEEN  17 and 23) AND (gender = 1 )
GROUP BY u.id" ;

/**************************************************/


/********************************   Задание номер 2   ***********************************************/
// требуется
$str = "https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html".'<br>';
echo   " <b> <h3>Требуется:</h3> ". str_ireplace("&", "&#38;", $str) ;


// Выводим на экран
echo " <b> <h3>Итог:</h3> ";
 echo   str ( "https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3") .'<br>';

function str($str) {


    $arr = array();
    $str = str_ireplace("test/index.html", "", $str);

    $str_data = strstr($str, '?'  );
    $str_url = strstr($str, '?' ,true );
    $str_data = str_ireplace("?", "&", $str_data);
    $str = str_ireplace("?", "&", $str);
    $count=substr_count($str, '&');

    for ($i = 1; $i < $count; $i++) {
     $par=   explode('&', $str_data, 8);
        $arr[$i]=  substr($par[$i], -1);
    }

    asort($arr);

    foreach ($arr as $key => &$vale) {
        //Удаляем с значением 3
        if ($arr[$key]==='3') {
            unset($par[$key]);
        } else { // добавляем к строке нужное
            $stroka = $stroka . $par[$key] . "&#38;";
        }
    }
    return "<br>".$str_url."?".$stroka."url=%2Ftest%2Findex.html";
}


/********************************   Задание номер 3   ***********************************************/

//$data = load_users_data($_GET['user_ids']);

// Входные данные
$data = load_users_data("1,2,3");


foreach ($data as $user_id=>$name) {
    // Выводим результат
echo "<a href=\"/show_user.php?id=$user_id\">$name</a> <br>";
}

function load_users_data($user_ids)
{
    // Отделяем нужные нам данные и складываем в массив
    $user_ids = explode(',', $user_ids);
    // соеденяемся с базой
    $db = @mysqli_connect("localhost", "root", "123123", "database");
    if (!$db) { // Если ошибка соединения выводим ее на экран
        die('Ошибка при подключении: ' . mysqli_connect_error());
    }
    // Цикл из входящих данных массива
 foreach ($user_ids as $user_id) {
     //Запрашиваем данные
    $sql =   mysqli_query($db, "SELECT * FROM users WHERE id=".$user_id);
      while ($obj = $sql->fetch_object())  { 
         //Складываем в массив полученные данные
          $data[$user_id] = $obj->name;
        }
    }
 // Закрываем соединение
    mysqli_close($db);
 // Возвращаем готовый массив
    return $data;
}











    ?>



