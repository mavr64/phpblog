<!--СПИСОК ПЕРЕМЕННЫХ В ШАБЛОНЕ
    $title
    $articles
    $isAuth
    $content
-->
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
	<title><?=$title?></title>
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="header line">
				<div class="wrapper">
					<div class="logo"></div>
					<div class="slogan">
						<div class="title">Рога и копыта</div>
						<div class="subtitle">Копытом бьем, рога ломаем...</div>
					</div>
					<div class="phone">8 800 800 80 80</div>
				</div>
			</div>		
			<div class="menu line">
				<div class="wrapper">
					<nav>
						<div class="show_menu">Меню</div>
						<ul>
							<li><a href="/">Главная</a></li>
							<li><a href="post/add">Добавить статью</a></li>
							<li><a href="#">Продукты</a></li>
							<li><a href="#">Услуги</a></li>
							<li><a href="#">Контакты</a></li>
						</ul>					
					</nav>
				</div>
			</div>		
		</header>
		<section>
			<div class="content line">
				<div class="wrapper">
					<aside class="left">
						<div class="col fl-l">
							<span class="h3"><?=$title?>:</span>
							<ul>
<?php
//var_dump($articles);
//		foreach($articles as $art):
//		?>
<!--			<li>-->
<!--				<a href="post/one/--><?php //echo $art['id_article']?><!--" class="articles_link">-->
<!--				--><?php //echo $art['title']?><!--</a>-->
<!--			</li>-->
<!--		--><?php
//		endforeach;?>
								<li><a href="#">Прайсы</a></li>
								<li><a href="#">Сорта рогов</a></li>
								<li><a href="#">Сроки поставки</a></li>
							</ul>
						</div>
						<div class="col fl-r">
							<span class="h3">Пользователю:</span>
							<ul>
								<li><?php
    // проверка на сессию либо куки
    if ($isAuth){?>
            Вы вошли как <?php echo "admin"?></li>
            <li><a href="index.php?c=login">Выход</a>
<?php 
	}
    else{?>
        <div class="nav"><a href="index.php?c=login">Авторизация</a></div>
<?php 
	}
?></li>
								<li><a href="#">__________</a></li>
							</ul>
						

						</div>
						<div class="clear"></div>
					</aside>
					<section class="right">
						<?=$content?>
					</section>
					<div class="clear"></div>
				</div>
			</div>
		</section>
		<footer>
			<div class="footer line">
				<div class="wrapper">
					<span class="copy">&copy; SVlad'2000, Саратов 2018, все права защищены</span>
				</div>
			</div>
		</footer>
	</div>	
	<script src="assets/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="assets/js/scripts.js" type="text/javascript"></script>
</body>
</html>