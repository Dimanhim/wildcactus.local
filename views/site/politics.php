<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Политика конфиденциальности</title>
	<!-- fonts -->
	<link rel="stylesheet" href="/web/fonts/fa/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;subset=cyrillic-ext" rel="stylesheet">
	<!-- bootstrap -->
	<link rel="stylesheet" href="/web/css/bootstrap.min.css">
	<link rel="stylesheet" href="/web/css/bootstrap-reboot.min.css">
	<!-- Slick slider -->
	<link rel="stylesheet" href="/web/css/slick.css">
	<link rel="stylesheet" href="/web/css/slick-theme.css">
	<!-- lightbox -->
	<link rel="stylesheet" href="/web/css/lightbox.min.css">
	<!-- modal -->
	<link rel="stylesheet" href="/web/css/jquery.arcticmodal-0.3.css">
	<!-- style -->
	<link rel="stylesheet" href="/web/css/main.css">
</head>
<body>
	<header class="header" id="header">
		<nav>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-3 d-sm-flex d-none">
						<a href="/">
							<img src="/web/img/logo.svg" alt="miniMBA" class="logo">
						</a>
					</div>
					<div class="col-3 d-sm-none">
						<a href="/">
							<img src="/web/img/logo_mini.svg" alt="miniMBA" class="logo" title="Вернуться назад">
						</a>
					</div>
					<div class="col-lg-6 col-sm-5 text-center d-sm-block d-none">
						<a href="tel:<?= $header->phone ?>" class="phone"><?= $header->phone ?></a>
						<a href="mailto:<?= $header->email ?>" class="mail"><?= $header->email ?></a>
					</div>
					<div class="col-lg-3 col-sm-4 col-7">
						<a href="#" class="btn btn__header">Записаться</a><br />
						
					</div>
					<div class="col-2 col-sm-1 d-sm-none text-right">
						<a href="#" class="header__hamburg" >
							<i class="fa fa-bars" ></i>
						</a>
					</div>
					<div class="header__menu d-none">
						<hr>
						<p class="hamburg__text">
							Позвоните нам
						</p>
						<div class="hamburg__wrapp">
							<i class="fal fa-phone"></i>
							<a href="tel:89995957629" class="hamburg__tel">8 999 595-76-29</a>
						</div>
						
						<p class="hamburg__text">
							Напишите нам
						</p>
						<div class="hamburg__wrapp">
							<i class="fal fa-envelope"></i>
							<a href="mailto:edu@vseinstrumenti.ru" class="hamburg__mail">edu@vseinstrumenti.ru</a>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>

	<div class="privacy">
		<div class="container">
			<div class="back">
				<img src="/web/images/arroe-left.jpg" alt="" />
				<a href="/">Вернуться назад</a>
			</div>
			<h3 class="privacy__title">
				Политика конфиденциальности
			</h3>
			<p class="privacy__text">
				Сайт mini-MBA ВсеИнструменты.ру ценит доверие своих клиентов и заботится о сохранении их личных (персональных) данных в тайне от мошенников и третьих лиц. Эта Политика конфиденциальности разработана для того, чтобы данные, предоставленные клиентами, были в сохранности и защищались от доступа третьих лиц. Сайт mini-MBA собирает ваши личные (персональные) сведения исключительно для того, чтобы совершенствовать качество обслуживания и эффективность нашего взаимодействия.
			</p>
			<p class="privacy__caption">
				1. Общие вопросы
			</p>
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						1.1. Настоящая Политика конфиденциальности описывает методы использования и хранения сайта-визитки mini-MBA ВсеИнструменты.ру конфиденциальной информации клиентов, посещающих сайт название домена.
					</li>
					<li class="privacy__item">
						1.2. Предоставляя сайту mini-MBA ВсеИнструменты.ру информацию частного характера через сайт название домена, клиент свободно, своей волей дает согласие на передачу, использование и раскрытие его персональных данных согласно условиям настоящей Политики конфиденциальности.
					</li>
					<li class="privacy__item">
						1.3. Настоящая Политика конфиденциальности применяется только в отношении информации частного характера, полученной через данный сайт. Информация частного характера – это информация, позволяющая при ее использовании отдельно или в комбинации с другой доступной интернет-магазину информацией идентифицировать персональные данные клиента.
					</li>
					<li class="privacy__item">
						1.4. Сайт не содержит материалов, неприемлемых для детей и подростков младше 14 лет. Однако они не могут передавать никакие личные данные через интернет без согласия одного из родителей или опекуна. Сайт mini-MBA ВсеИнструменты.ру гарантирует, что сознательно не собирает и не хранит никаких личных данных, связанных с несовершеннолетними лицами.
					</li>
					<li class="privacy__item">
					</li>	
					<li class="privacy__item">
					</li>		
				</ul>
			</p>

			<p class="privacy__caption">
				2. Данные, которые получает сайт
			</p>
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						2.1. Если пользователь не зарегистрирован на сайте, просмотр содержимого на ресурсе – анонимный. Серверы сайта название домена могут собирать для статистики информацию о типе браузера, компьютера и операционной системы, а также IP-адрес.
					</li>
					<li class="privacy__item">
						2.2. Какие данные зарегистрированных пользователей собираются и сохраняются?
					</li>
					<li class="privacy__item">
						2.2.1. Персональная информация, а также любая другая информация, которую клиенты сознательно и добровольно передают в процессе заполнения формы обратной связи:
						<ul class="privasy__list">
							<li class="privacy__item privacy__item2">
								•	фамилия, имя, отчество;
							</li>
							<li class="privacy__item privacy__item2">
								•	e-mail;
							</li>
							<li class="privacy__item privacy__item2">
								•	мобильный телефон.
							</li>
						</ul>	
					</li>
					<li class="privacy__item">
						2.2.2. Информация от браузера – данные, которые браузер автоматически отправляет серверу, например: IP-адрес, историю последних посещений, название операционной системы, название и версию программы, через которую клиент осуществляет выход в интернет, дату и время посещения сайта пользователем. Можно запретить браузеру передавать подобную информацию путем изменения настроек.
					</li>
					<li class="privacy__item">
						С какой целью собирается: Сайт mini-MBA ВсеИнструменты.ру ведет статистику посещений для функционирования своих серверов и учета собственного трафика. В данном случае собранная статистическая информация не ассоциируется с конкретными пользователями и обрабатывается только в виде обобщенной статистики. IP-адрес клиента и время доступа к системе, в соответствии с пользовательским идентификатором, сохраняются в базе данных в целях предотвращения мошенничества.
					</li>	
					<li class="privacy__item">
					</li>		
				</ul>
			</p>

			<p class="privacy__caption">
				3. Охрана личной информации пользователей
			</p>
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						3.1. Сайт mini-MBA ВсеИнструменты.ру никогда и ни при каких обстоятельствах не сообщает третьим лицам личную (персональную) информацию о своих клиентах, кроме случаев, предписанных Федеральным законом от 27.07.2006 г. № 152-ФЗ «О персональных данных», или когда клиент добровольно соглашается на передачу информации.
					</li>
					<li class="privacy__item">
						3.2. Сайт mini-MBA ВсеИнструменты.ру реализует мероприятия по защите личных (персональных) данных клиентов в следующих направлениях:
						<ul class="privasy__list">
							<li class="privacy__item privacy__item2">
								•	предотвращение утечки информации, содержащей личные (персональные) данные, по техническим каналам связи и иными способами;
							</li>
							<li class="privacy__item privacy__item2">
								•	предотвращение несанкционированного доступа к информации, содержащей личные (персональные) данные, специальных воздействий на такую информацию (носителей информации) в целях ее добывания, уничтожения, искажения и блокирования доступа к ней;
							</li>
							<li class="privacy__item privacy__item2">
								•	защита от вредоносных программ;
							</li>
							<li class="privacy__item privacy__item2">
								•	обнаружение вторжений и компьютерных атак.
							</li>
						</ul>	
					</li>		
				</ul>
			</p>

			<p class="privacy__caption">
				4. Время хранения информации
			</p>
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						4.1. Сайт mini-MBA ВсеИнструменты.ру хранит частную информацию клиентов ровно столько времени, сколько она остается необходимой для достижения тех целей, ради которых она была изначально получена, или других законных целей, за исключением случаев, когда более длительный период хранения информации необходим в соответствии с законодательством либо разрешен им.
					</li>
					<li class="privacy__item">
						4.2. Если пользователь отзывает свое согласие на хранение и обработку персональных данных, то он должен обратиться с просьбой удалить их, написав письмо на электронную почту edu@.vseinstrumenti.ru.
					</li>
					<li class="privacy__item">
						4.3. Сайт mini-MBA ВсеИнструменты.ру осуществляет уничтожение персональных данных путем определенных действий, в результате которых становится невозможным восстановить содержание персональных данных в информационной системе персональных данных и  в результате которых уничтожаются материальные носители персональных данных
					</li>
					<li class="privacy__item">
						4.4. Персональные данные на материальных носителях уничтожаются путем сжигания или шредирования (разрезания на мелкие части). Данные на магнитных носителях, т.е. файлы, подлежащие уничтожению и находящиеся на жёстком диске компьютера, удаляются средствами операционной системы с дальнейшим очищением корзины.
					</li>	
				</ul>
			</p>

			<p class="privacy__caption">
				5. Сотрудничество с государственными органами
			</p>
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						Существуют ограниченные условия, при которых сайт mini-MBA ВсеИнструменты.ру может предоставить информацию частного характера из своих баз данных сторонним третьим лицам:
						<ul class="privasy__list">
							<li class="privacy__item privacy__item2">
								•	в целях удовлетворения требований, запросов или распоряжения суда;
							</li>
							<li class="privacy__item privacy__item2">
								•	в целях сотрудничества с правоохранительными, следственными или другими государственными органами. При этом Сайт mini-MBA ВсеИнструменты.ру оставляет за собой право сообщать в государственные органы о любой противоправной деятельности без уведомления пользователя об этом;
							</li>
							<li class="privacy__item privacy__item2">
								•	в целях предотвращения или расследования предполагаемого правонарушения, например, мошенничества или кражи идентификационных данных;
							</li>
							<li class="privacy__item privacy__item2">
								•	в целях защиты юридических прав, прав собственности или безопасности сайта, сотрудников, агентов, других пользователей и общества в целом.
							</li>
						</ul>	
					</li>		
				</ul>
			</p>

			<p class="privacy__caption">
				6. Согласия на обработку персональных данных
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						Настоящим свободно, своей волей и в своем интересе даю согласие ООО «ВсеИнструменты.ру», которое находится по адресу: г. Москва, ул. Братиславская,  д.16 , корп.1, пом.3 (далее – Сайт mini-MBA ВсеИнструменты.ру), на автоматизированную и неавтоматизированную обработку моих персональных данных в соответствии со следующим перечнем:
						<ul class="privasy__list">
							<li class="privacy__item privacy__item2">
								•	источник захода на веб-сайт:  название домена  (далее – Сайт mini-MBA ВсеИнструменты.ру) и информация поискового или рекламного запроса;
							</li>
							<li class="privacy__item privacy__item2">
								•	данные о пользовательском устройстве (среди которых разрешение, версия и другие атрибуты, характеризующие пользовательское устройство);
							</li>
							<li class="privacy__item privacy__item2">
								•	пользовательские клики, просмотры страниц, заполнения полей, показы и просмотры баннеров и видео;
							</li>
							<li class="privacy__item privacy__item2">
								•	данные, характеризующие аудиторные сегменты;
							</li>
							<li class="privacy__item privacy__item2">
								•	параметры сессии;
							</li>
							<li class="privacy__item privacy__item2">
								•	данные о времени посещения;
							</li>
						</ul>	
					</li>
					<li class="privacy__item">
						для целей повышения осведомленности посетителей сайта mini-MBA ВсеИнструменты.ру об услугах , предоставления релевантной рекламной информации и оптимизации рекламы.
					</li>	
					<li class="privacy__item privacy__item_top">
						Настоящее согласие вступает в силу с момента моего перехода на сайт mini-MBA ВсеИнструменты.ру -  название домена и действует в течение сроков, установленных действующим законодательством РФ.
					</li>	
				</ul>
			</p>

			<p class="privacy__caption">
				7. Внесение изменений и дополнений
			</p>
			<p class="privacy__text">
				<ul class="privacy__punkt">
					<li class="privacy__item">
						Все изменения положений или условий политики использования личной информации будут отражены в этом документе. Сайт mini-MBA ВсеИнструменты.ру оставляет за собой право вносить изменения в те или иные разделы данного документа в любое время без предварительного уведомления, разместив обновленную версию настоящей Политики конфиденциальности на сайте на этой странице. С момента ее опубликования пользователи подчиняются новым условиям Политики конфиденциальности.
					</li>
				</ul>
			</p>
		</div>
	</div>


	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4">
					<div class="footer__contact">
						<a href="tel:<?= $header->email2 ?>" class="footer__mail2 text-center">
							<?= $header->email2 ?>
						</a>
						<p class="footer__copyright">
							© 2006-2019 ВсеИнструменты.ру
						</p>
						<p class="footer__mail">
							E-mail:
							<a href="mailto:<?= $header->email ?>" class="footer__mail">
								<?= $header->email ?>
							</a>
						</p>
						<p class="footer__tel">
							Тел:
							<a href="tel:<?= $header->email2 ?>" class="footer__mail">
								<?= $header->email2 ?>
							</a>
							(c 9:00 до 19:00)
						</p>							
					</div>
				</div>
				<div class="col-lg-3 offset-lg-0 offset-md-4  col-md-8  order-md-1  order-lg-0">
					<div class="footer-link__wrap">
						<p class="footer__text d-none d-md-inline">
							Присоединяйтесь к нам:
						</p>
						<div class="footer__links">
							<a href="https://m.facebook.com/vseinstrumenti" target="blanc"><i class="fab fa-facebook-f"></i></a>
							<a href="#" target="blanc"><i class="fab fa-vk"></i></a>
							<a href="https://www.instagram.com/vseinstrumentirulyat/" target="blanc"><i class="fab fa-instagram"></i></a>	
						</div>
					</div>					
				</div>
				<div class="col-lg-6 col-md-8">
					<p class="footer__text">
						Вся информация на сайте – собственность интернет-магазина vseinstrumenti.ru
						Информация на сайте (адрес сайта) не является публичной офертой.
						Вы принимаете условия политики конфиденциальности каждый раз, когда оставляете свои данные в любой форме на сайте ( адрес сайта)
					</p>
				</div>
			</div>
		</div>		
	</footer>


<!-- Модальное окно 2 -->
<div class="modal-window" style="display: none;">
    <div class="box-modal" id="exampleModal2">
        <div class="box-modal_close arcticmodal-close">
			<i class="fal fa-times"></i>
        </div>
        <div class="modal2__wrapp">
        	<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
        	<p class="modal2__title text-center">
        		Записаться на обучение
        	</p>
        	<p class="modal2__text text-center">
        		Запишитесь на обучение и получите бесплатную оценку своих компетенций экспертом! 
        	</p>
        	<div class="modal2__input">
        		<?= $form->field($modalform, 'name', ['template' => "{input}"])->textInput(['class' => "forma__input forma__input-modal border", 'placeholder' => "Имя", 'required' => "required"]) ?>
        		<?= $form->field($modalform, 'phone', ['template' => "{input}"])->textInput(['class' => "forma__input forma__input-modal border", "id" => "phone3", 'placeholder' => "Телефон", 'required' => "required"]) ?>
        		<?= $form->field($modalform, 'email', ['template' => "{input}"])->textInput(['class' => "forma__input forma__input-modal border", 'placeholder' => "E-mail", 'required' => "required"]) ?>
        		<?= $form->field($modalform, 'btn', ['template' => "{input}"])->hiddenInput(['value' => "Модальное окно - записаться на обучение"]) ?>
        	</div>
        	<?= Html::submitButton('Записаться', ['class' => "btn modal2__btn"]) ?>
        	
			<div class="checkbox text-center">
				<label>
					<input type="checkbox" hidden checked>
					<span></span>
					Даю согласие на обработку моих 
					<a href="<?= Yii::$app->urlManager->createUrl(['site/politics']) ?>" target="blanc" class="private">
					персональных данных
					</a>
				</label>
			</div>
			<?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<!-- Успешная отправка -->
<div style="display: none;">
    <div class="box-modal" id="successModal">
        <div class="box-modal_close arcticmodal-close">
			<i class="fal fa-times"></i>
        </div>
        <div class="modal2__wrapp">
        	<p class="modal2__title text-center">
        		Ваша заявка<br /> успешно отправлена
        	</p>
        	<p class="modal2__text text-center">
        		Наши специалисты свяжутся с Вами в ближайшее время! 
        	</p>
        </div>
    </div>
</div>



<script src="/web/js/jquery-3.3.1.min.js"></script>
<script src="/web/js/slick.min.js"></script>
<script src="/web/js/jquery.arcticmodal-0.3.min.js"></script>
<script src="/web/js/main.js"></script>
<script src="/web/js/jquery.nicescroll.js"></script>
<script src="/web/js/jquery.fancybox.min.js"></script>
<script src="/web/js/jquery.maskedinput.min.js"></script>
<script src="/web/js/go_top.js"></script>
<script>
/*$(document).ready(function() {
$("html").niceScroll({cursorcolor:"#666666",cursorfixedheight:'60'});
});*/
</script>
<script>
    $(document).on("submit", "form", function (e) {
        var form = $(this);
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (response) {
                if($('#exampleModal').is(':visible')) $('#exampleModal').arcticmodal("close");
                if($('#exampleModal2').is(':visible')) $('#exampleModal2').arcticmodal("close");
                $('#successModal').arcticmodal();
            },
            error: function () {
                alert('Произошла ошибка отправки, попробуйте позднее');
            }
        });
        return false;
    });
</script>



</body>
</html>