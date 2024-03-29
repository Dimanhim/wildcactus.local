PostcalcLight - это библиотека для работы с Postcalc.RU и простой веб-интерфейс в одном архиве.

PostcalcLight объявляется public domain, то есть вы можете использовать его в своих проектах полностью 
или частично без ограничений.

Библиотека легковесная, в сжатом виде - около 30 Кб в архиве,  основная функция опроса - менее 40 строк кода. 

Начиная с версии 2.0 (декабрь 2015 г.) база данных скачивается отдельно. Она предоставляется в двух форматах
на выбор: простых текстовых файлов (аналогично версии 1.x) и дампа MySQL. 

ЗАГРУЗКА
Для кодировки UTF-8:
http://www.postcalc.ru/download/PostcalcLight_UTF8.zip - последняя версия программы, 26 Кб.
http://www.postcalc.ru/download/PostcalcLight_UTF8_TXT.zip - последняя версия базы данных в формате TXT, около 640 Кб.

Для кодировки Windows-1251:
http://www.postcalc.ru/download/PostcalcLight_cp1251.zip - последняя версия программы, 24 Кб.
http://www.postcalc.ru/download/PostcalcLight_cp1251_TXT.zip - последняя версия базы данных в формате TXT, около 570 Кб.

Для любой кодировки:
http://www.postcalc.ru/download/PostcalcLight_SQL.zip - последняя версия базы данных в формате дампа MySQL,  около 670 Кб.

Все приведенные выше ссылки являются символьными ссылками на самую последнюю версию программы или базы данных.
При желании вы можете настроить скрипты на вашем сайте для обновления в автоматическом режиме.
Все существующие версии можно посмотреть по ссылке:
http://www.postcalc.ru/download/PostcalcLight/

Базы данных основаны на "Эталонном справочнике" Почты России:
http://vinfo.russianpost.ru/database/ops.html

Они обновляются в автоматическом режиме еженедельно. Однако большого смысла обновлять их часто нет, так как изменения обычно
не касаются клиентов: добавляются/изменяются технические индексы, которые используются во внутренней обработке Почты России. 

По практике, достаточно обновлять базы раз в квартал.

БАЗА ДАННЫХ
Какой формат выбрать (SQL или TXT) - дело больше вкуса. 

Текстовые файлы не требуют дополнительной настройки и доступа к базе данных, работают сразу "из коробки". 

База MySQL дает возможность интеграции с другими вашими проектами.

1. Файлы в формате текста, разделенного табуляцией, и соответствующие индексные файлы:
   postcalc_light_cities.txt
   postcalc_light_cities.idx
   postcalc_light_post_indexes.txt
   postcalc_light_post_indexes.idx
   postcalc_light_countries.txt
   
Хотя файлы имеют вид обычного текста, изменять их НЕЛЬЗЯ, так как это приведет к нарушению работы.

Для настройки пишем в конфигурационном файле postcalc_light_config.php:
 'source' => 'txt',
 'txt_dir' => __DIR__,

Если файлы баз данных находятся в том же каталоге, что и файл postcalc_light_lib.php, то параметр txt_dir можно оставить как есть, 
то есть __DIR__. Иначе укажите полный маршрут к ним.

2. Дамп базы данных MySQL postcalc_light.sql. Его необходимо импортировать в текущую базу данных через phpmyadmin или войти в каталог
PostcalcLight и выполнить из командной строки:
mysql -u<пользователь> -p<пароль> <база_данных> < postcalc_light.sql

Для настройки пишем в конфигурационном файле postcalc_light_config.php:
    'source' => 'mysql',  
    'mysql_host' => 'localhost',    // Для mysql: имя хоста
    'mysql_user' => 'testuser',     // Для mysql: имя пользователя БД
    'mysql_pass' => 'testpass',     // Для mysql: пароль пользователя БД
    'mysql_db'   => 'postcalc',     // Для mysql: имя базы данных
    

ИЗМЕНЕНИЯ
ВЕРСИЯ 2.0 - 20 декабря 2015 г.
1. Добавлены конфигурационные параметры city_as_pindex и dir_txt. Эти переменные обязательно должны присутствовать в конфигурационном файле!

2. Изменен формат текстовой базы данных - теперь это стандартный Tabbed Separated Values, который можно импортировать в БД SQL. 
Для таблиц postcalc_light_post_indexes.txt и postcalc_light_cities.txt генерируются индексные файлы с тем же именем и расширением .idx.
Не удаляйте их и не вносите изменения в эти файлы - это приведет к сбою.

3. Удалена таблица postcalc_light_locations.txt. Поддержка названий регионов типа 'Ленинградская область' пока сохраняется на уровне API, 
однако в будущем может быть также прекращена. В планируемом API 2.0 будут стандартно поддерживаться либо 6-значные индексы, либо названия
населенных пунктов из postcalc_light_cities.txt.

ВЕРСИЯ 2.1 - 26 января 2016 г.
1. Откорректирован принцип, по которому формируются названия населенных пунктов из трех частей: 3-я часть теперь строго следует
официальному справочнику ОКТМО. 

2. Список индексов обновлен по состоянию на 18 января 2016 года. 

3. Исправлены небольшие ошибки в коде.

ВЕРСИЯ 2.2 - 28 июня 2016 г.

Изменения в дизайне клиента. Библиотека не изменилась.

1. Добавлен конфигурационный параметр debug. Если 1 - под таблицей с тарифами выводится полный массив ответа сервера.
Переменная [_server][REMOTE_ADDR] содержит реальный IP, с которого ушел запрос клиента.

2. Добавлен конфигурационный параметр arrColumns. Можно включать/отключать вывод следующих колонок таблицы: 
Количество, Тариф, Страховка, Доставка, Ценность, Срок доставки.

3. Добавлены конфигурационные параметры skin и arrSkins. Параметр skin - выбор одной из 24 доступных тем оформления
из стандартной библиотеки jQuery UI. Доступные темы можно посмотреть по ссылке:
http://jqueryui.com/themeroller/

4. Добавлен конфигурационный параметр arrParcels - список всех возможных отправлений. 
Чтобы ненужные виды отправлений не выводились в итоговой таблице, просто закомментируйте их в arrParcels.

5. Если доставка в конечный пункт имеет сезонные ограничения, выводится таблица с информацией по ограничениям.

ВЕРСИЯ 2.3 - 26 апреля 2017 г.

Если установлена библиотека PHP curl, то обращение к серверам проекта делается через нее, иначе - через функцию
file_get_contents. Функция file_get_contents из-за особенностей архитектуры делает вместо одного обращения 
к серверу два, что увеличивает время обслуживания по логам сервера в 2 раза, а реально - примерно в 1.5 раза.

Никаких изменений в пользовательский код вносить не требуется.

ВЕРСИЯ 2.4 - 16 ноября 2017 г.
1. В таблицу postcalc_light_post_indexes добавлен условный почтовый индекс 000000, поле opsname которого содержит дату и номер
"Эталонного справочника почтовых индексов ОПС" Почты России, из которого была сгенерирована данная таблица. 

"Эталонный справочник" находится по ссылке:
http://vinfo.russianpost.ru/database/ops.html

2. Поле city в таблице postcalc_light_cities теперь формируется только из "Эталонного справочника почтовых индексов", без привлечения
иных источников. Таким образом, произошел возврат к формату поля city, который был до версии 2.1 (январь 2016 года). В целом настоятельно 
рекомендуется использовать настройку по умолчанию city_as_pindex = 1.

ОСНОВНЫЕ ВОЗМОЖНОСТИ

1. Можно скачать два варианта базы данных: в формате простого текста, разделенного табуляцией, и формате дампа MySQL.
По умолчанию программа настроена на базу в формате текста и работает "из коробки", без дополнительных настроек. 

Базы данных сгенерированы на основе Эталонного справочника Почты России и обновляются в автоматическом режиме.

2. Проверка аргументов на правильность. Отправитель и получатель проверяются по базам данных, которые полностью
синхронизированы с базами данных postcalc.ru.

3. Правильное перекодирование аргументов.

4. Опрос в цикле доступных серверов проекта Postcalc.RU: если один сервер недоступен, запрашивается следующий.

5. Разархивирование ответа и перевод его в массив PHP.

6. Кэширование правильного ответа.

7. Настройка всех необходимых параметров в конфигурационном файле.

8. Для дизайна была использована тема Start из стандартной библиотеки jQuery UI. 
При желании ее можно заменить на любую другую из 24 тем библиотеки. Для этого установите параметр skin в конфигурационном файле.

Для просмотра доступных тем пройдите по ссылке:
http://jqueryui.com/themeroller/
Слева на странице в виде вертикальной колонки с черным фоном находится ThemeRoller. Щелкните по второй закладке "Gallery" -
появятся изображения календарей с разным дизайном. Если вы нажмете по изображению одного из календарей, его дизайн будет 
присвоен всей странице. 

9. Автодополнение индекса отделения связи и населенного пункта для полей "Откуда" и "Куда".

10. Javascript необязателен - он используется только в автодополнении и некоторых элементах дизайна.

11. Ведение журналов успешных и неуспешных соединений. Скрипт postcalc_light_stat.php позволяет просматривать статистику 
по месяцам и дням, скрипт postcalc_light_view_log.php - собственно журналы (они разбиты по месяцам).

12. После 10 неуспешных соединений на контактный email отсылается уведомление о сбое (параметр error_log_send).

13. При необходимости - доступ к статистике по паролю (см. postcalc_light_pass в конфигурационном файле).

ИСПОЛЬЗОВАНИЕ

1. Разархивируйте PostcalcLight_UTF8.zip или PostcalcLight_cp1251.zip в каталог веб-сервера.

2. Настройте базу данных. 

Если вы предпочитаете работать с базой в формате текстовых файлов, разархивируйте содержимое
PostcalcLight_UTF8_TXT.zip или PostcalcLight_cp1251_TXT.zip в тот же каталог.

Если вы выбрали работу с сервером MySQL, скачайте и разархивируйте PostcalcLight_SQL.zip. 
Затем воспользуйтесь для импорта дампа программой phpmyadmin или войдите в каталог PostcalcLight и 
выполните из командной строки:
mysql -u<пользователь> -p<пароль> <база_данных> < postcalc_light.sql

Далее укажите имя сервера, название базы данных, логин и пароль в конфигурационном файле postcalc_light_config.php.

3. Для проверки откройте в веб-браузере страницу /PostcalcLight/postcalc_light_test.php - она обратится к серверу Postcalc.RU, 
используя библиотеку PostcalcLight, и, если все в порядке, нарисует таблицу. 

4. Откройте в веб-браузере страницу /PostcalcLight/postcalc_light.php - это простой клиент для работы с Postcalc.RU.

5. Окончательно настройте клиент в рабочем режиме: откройте файл postcalc_light_config.php и 
правильно заполните значение следующих переменных:

st - Название сайта, без http: и слэшей
ml - Контактный email. Самый принципиальный параметр. Обязательно проверьте, доходит ли почта с сервера postcalc.ru:
http://www.postcalc.ru/check_email.php
default_from - Почтовое отделение отправителя по умолчанию.

Также полезно заполнить следующие параметры:
cache_dir - каталог, доступный для записи веб-серверу. Там будут храниться журналы соединений и кэш. 
По умолчанию это /tmp, однако все файлы из этого каталога при перезагрузке вашего сервера автоматически удаляются.
r - округление тарифов, в рублях. По умолчанию 0.01 - т.е. округление до копеек.
pr - единовременная наценка в рублях на заказ.

Также вы можете изменить значение других переменных запроса - их описание имеется в файле postcalc_light_config.php.

6. Следите за работой библиотеки через /PostcalcLight/postcalc_light_stat.php.

=========================================================
СПИСОК ФАЙЛОВ

ПРОГРАММА
postcalc_light.php - веб-интерфейс к клиентской библиотеке postcalc_light_lib.php. 
postcalc_light_auth.php - форма авторизации. 
postcalc_light_autocomplete.php - поддержка автодополнения для полей "Откуда" и "Куда".
postcalc_light_config.php - конфигурационный файл. Настоятельно рекомендуется прочитать комментарии в нем.
postcalc_light_lib.php - клиентская библиотека. Настоятельно рекомендуется ознакомиться с документацией: http://www.postcalc,ru/doc/PostcalcLight/
postcalc_light_stat.php - статистика по месяцам и дням.
postcalc_light_test.php - простой файл для тестирования.
postcalc_light_view_log.php - просмотр журналов соединений.
postcalc_light_form_plugin.js - плагин jQuery для поддержки веб-интерфейса.

БАЗА ДАННЫХ В ФОРМАТЕ ТЕКСТА, РАЗДЕЛЕННОГО ТАБУЛЯЦИЕЙ:
postcalc_light_cities.txt - список населенных пунктов и отделений связи по умолчанию для них.
postcalc_light_cities.idx - индексный файл для postcalc_light_cities.txt.
postcalc_light_post_indexes.txt - список 6-значных индексов отделений связи и названий отделений связи.
postcalc_light_post_indexes.idx - индексный файл для postcalc_light_post_indexes.txt
postcalc_light_countries.txt - список стран и аббревиатур. Индексного файла для него нет.

БАЗА ДАННЫХ В ФОРМАТЕ ДАМПА MYSQL:
postcalc_light.sql
