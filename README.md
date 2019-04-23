# ertktest

<h2>Требования</h2>
<pre>
Веб сервер, MySQL >= 5.6 , PHP >= 7 , GIT , Composer
</pre>

<h2>Установка</h2>

<b>0)</b> Cклонируйте проект в нужную директорию
	<pre>git clone https://github.com/andreivadimovich/ertktest.git</pre>

<b>1)</b> В директории проекта выполните:
	<pre>php -d memory_limit=-1 composer update</pre>

<b>2)</b> Настройте соединение с базой данных (в файле .env):
	<pre>DATABASE_URL=mysql://user:pwd@127.0.0.1:PORT/dbname</pre>

<b>3)</b> Запустите миграцию
	<pre>php bin/console doctrine:migrations:migrate</pre>

<b>4)</b> Настройте веб сервер на директорию ./public 

<b>5)</b> Перейдите на страницу проекта браузером, следуйте инструкциям

<hr />

<h2>Дополнительно</h2>
Схема БД. Изображение
<a href="https://www.dropbox.com/s/kodhy0mi2uk2thv/db.png?dl=0">https://www.dropbox.com/s/kodhy0mi2uk2thv/db.png?dl=0</a>
<br />
DDL dump <a href="https://www.dropbox.com/s/qkh1yhenjj61el0/ertk.sql?dl=0">https://www.dropbox.com/s/qkh1yhenjj61el0/ertk.sql?dl=0</a>
<br />
DML dump <a href="https://www.dropbox.com/s/z7qvrw2d43duxn2/sql_data.sql?dl=0">https://www.dropbox.com/s/z7qvrw2d43duxn2/sql_data.sql?dl=0</a>
	

<h3>Демо системы</h3>
<img src="https://raw.githubusercontent.com/andreivadimovich/ertktest/master/demo.gif" width="860" height="606" />
