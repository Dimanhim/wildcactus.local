<?php

// Пример обращения к API сервиса расчета почтовых тарифов Postcalc.RU.
// Реализованы переключение на резервный сервер и кэширование ответов.
// Кэшировать можно в любом каталоге, который доступен для записи веб-сервером.

// === ИСХОДНЫЕ ДАННЫЕ
$id = $_GET['id'];
$From = '355029';
$To = $id;
$Weight = 300;
$Valuation = 500;
$Country = 'RU';

$Site = 'wildcactus.ru'; // Название сайта клиента
$Email = 'dimanhim@list.ru';   // Электронная почта для извещений о превышении лимита
$PostcalcServer1 = 'api.postcalc.ru';  // Рабочий сервер Postcalc.RU
$PostcalcServer2 = 'test.postcalc.ru'; // Резервное зеркало Postcalc.RU
$Timeout = 3; // При недоступности рабочего сервера переключиться на резервный через 3 сек.
$Charset = 'utf-8'; // Набор символов.
$CacheDir = sys_get_temp_dir(); // Каталог для хранения кэшированных данных.
$CacheValid = 600; // Кэш действителен в течение 600 сек.

// === СОБСТВЕННО РАСЧЕТ 
header("Content-Type: text/html; charset=$Charset");

// Формируем строку запроса со всеми необходимыми переменными
// Функция rawurlencode обязательна, если в качестве $From и $To выступают названия населенных пунктов. 
$QueryString  = 'f='  .rawurlencode( $From );
$QueryString .= '&t=' .rawurlencode( $To );
$QueryString .= "&w=$Weight&v=$Valuation&c=RU&o=php&cs=$Charset&st=$Site&ml=$Email";

// Очищаем кэш от устарелых данных - все файлы старше $CacheValid сек.
$TimestampNow = time();
foreach ( glob("$CacheDir/postcalc_*.txt") as $CacheFile ) 
	if ( ($TimestampNow - filemtime($CacheFile) )  > $CacheValid ) unlink( $CacheFile );

// Проверяем в кэше, не было ли уже такого запроса
$CacheFile = $CacheDir. '/postcalc_' .md5($QueryString) .'.txt';

if ( file_exists( $CacheFile ) ) {
	//echo "Найдено в кэше!<br>\n";
	$arrResponse = unserialize( file_get_contents($CacheFile) );
} else {

	// Формируем URL запроса - к рабочему и резервному серверу.
	$Request1="http://$PostcalcServer1/?$QueryString";
	$Request2="http://$PostcalcServer2/?$QueryString";
	
	// Формируем опции запроса. Это необязательно, однако упрощает контроль и отладку. Здесь же устанавливаем таймаут.
	$arrOptions = array('http' =>
	      array( 'header'  => 'Accept-Encoding: gzip','timeout' => $Timeout, 'user_agent' => phpversion() )
	             );
	
	// Соединяемся с рабочим сервером
	if ( !$Response=file_get_contents($Request1, false , stream_context_create($arrOptions)) ) {
	   // Если по какой-то причине рабочий сервер недоступен, переходим на резервное зеркало
	   if ( !$Response=file_get_contents($Request2, false , stream_context_create($arrOptions)) ) {
		   die("Не удалось соединиться с $PostcalcServer1 и $PostcalcServer2 в течение $Timeout сек.!");
	   }	
	}
	
	// Разархивируем ответ
	if ( substr($Response,0,3) == "\x1f\x8b\x08" )  $Response=gzinflate(substr($Response,10,-8));
	
	// Переводим ответ в массив PHP
	$arrResponse = unserialize($Response);
	
	// Обработка ошибки
	if ( $arrResponse['Status'] != 'OK' ) die("Сервер вернул ошибку: $arrResponse[Status]!");

	// Если ошибки не было, сохраняем ответ в кэше
	file_put_contents($CacheFile, $Response);

}

// === ВЫВОД РЕЗУЛЬТАТОВ
$values = $arrResponse['Отправления']['ЗаказноеПисьмо1Класс']['Тариф'];
//$values = $arrResponse['Отправления']['ПростаяБандероль']['Тариф'];
//print_r($arrResponse);
echo json_encode($values);
