<form action="" id="cdek" method="GET" />
<!-- Версия API -->
<input name="version" value="1.0" hidden />
<!-- Планируемая дата доставки (ГГГГ-ММ-ДД) -->
<?php
$dateExecute = date("Y-m-d");
$secure = md5($dateExecute."&".'qMNEuXgPLM5Ga8WPPQ1RhaOMvYb7eBzL');

?>
<input name="dateExecute" value="<?= $dateExecute ?>" hidden />

<!-- Для получения логина/пароля (в т.ч. тестового) обратитесь к разработчикам СДЭК -->
 	<!--<input name="authLogin" value="7JM7K5twfzEV1ssCRklthcIPbbVZrZrZ" hidden />
	<input name="secure" value="t8XBoL1rUofIK9dKoXVB3Tji2F2hPHSk" hidden />-->

<input name="authLogin" value="1xLOZnnkPEITL39eG0QfobVXrAKqytDN" hidden />
<input name="secure" value="<?= $secure ?>" hidden />
<!-- Город-отправитель, Ставрополь -->
<input name="senderCityId" value="439" hidden />
<!-- Город-получатель -->
<input name="receiverCityId" id="receiverCityId" value="" hidden />

<!-- <input name="tariffId" value="137" hidden /> --> <!-- id тарифа, Посылка склад-дверь 137, требутеся авторизация, параметры authLogin и secure -->
<!-- <input name="tariffId" value="11" hidden /> --> <!-- id тарифа, Экспресс-лайт склад-дверь 11, не требует авторизации -->
<input name="tariffId" value="136" hidden />

<!-- Используется для задания списка тарифов с приоритетами, подробнее см. документацию. -->
<!-- <input name="tariffList[0].priority" value="1" hidden /> -->
<!-- <input name="tariffList[0].id" value="137" hidden /> -->
<!-- <input name="tariffList[1].priority" value="2" hidden /> -->
<!-- <input name="tariffList[1].id" value="136" hidden /> -->

<!-- режим доставки, склад-дверь -->
<!-- <input name="modeId" value="3" hidden /> -->
<!-- Вес места, кг.  -->
<input name="goods[0].weight" value="1.0" hidden />
<!-- Длина места, см. -->
<input name="goods[0].length" value="20" hidden />
<!-- Ширина места, см. -->
<input name="goods[0].width" value="15" hidden />
<!-- Высота места, см. -->
<input name="goods[0].height" value="20" hidden />

<!-- Вес места, кг.-->
<input name="goods[1].weight" value="1.0" hidden />
<!-- объём места, длина*ширина*высота, метры кубические -->
<input name="goods[1].volume" value="0.001" hidden />

<button class="main-bt green">Посчитать</button>
</form>
