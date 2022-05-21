<?php
use app\lib\UserOperations;
/** @var array $content */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	
    <title><?= $this->title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />	
	<link href="/app/web/megamenu/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="/app/web/megamenu/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="/app/web/css/easydropdown.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="/app/web/css/flexslider.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/app/web/css/style.css">
</head>
<body>
<div class="wrap">
    <div class="container">
    <header class="header">
        <div class="header_menu">
            <div class="header_section">
                <div class="header_item headerButton"><a href="#">О нас</a></div>
                <div class="header_item headerButton"><a href="#">Новости</a></div>
                <div class="header_item headerButton"><a href="#">Условия работы</a></div>
                <div class="header_item headerButton"><a href="#">Отзывы</a></div>
                <div class="header_item headerButton"><a href="#">Контакты</a></div>
                <div class="header_item headerButton"><a href="#">Статьи</a></div>
            </div>
			
            <div class="header_section">
                <div class="header_item headerButton images"><img src="/app/web/images/entrance.png"></div>
                
				<?php if (empty($_SESSION['user'])) :?>
					<div class="header_item headerButton"><a href="/user/login">Вход\</a><a href="/user/registration">регистрация</a></div>
					<?php else : ?><span style="margin-left:10px;"><a href="/user/profile"><b>Привет <?=$_SESSION['user']['login'];?>!</b></a></span>
				<?php endif; ?>
            </div>
        </div>
        <div class="header_logo">
            <div class="header_logo_section">
                <div class=""><a href="/"><img src="/app/web/images/logo.png"></a></div>
                <a class="logo" href="">Саженцы цветов и<br>растений почтой</a>
            </div>
            <div class="header_logo_section">
                <div class="search">
                    <div class="telephone">
                        <p class="mode">РЕЖИМ РАБОТЫ</p>
                        <p class="bells">звонки по телефону</p>
                        <p class="numbers">ПН-ПТ 9:00-17:00</p>
                    </div>
                    <div class="telephone">
                        <p class="mode">ПОЗВОНИТЕ НАМ</p>
                        <p class="numbers">+7(978) 911-22-92</p>
                    </div>
                    <!--<div class="telephone"><a class="payment" href="">СООБЩИТЬ ОБ ОПЛАТЕ</a></div>-->
                </div>
                <!--<div class="search">
                    <form name="search" action="" method="get">
                        <input class="search_one" type="text" name="q" value="" placeholder="Поиск">
                        <input type="submit" value="" class="search_img" name="submit">
                    </form>
                </div>-->
            </div>
            <div class="header_logo_section">
                <div class="cart">
					<a href="/cart/cart">
						<img src="/app/web/images/basket.png">
						<span>
							<?php if (empty(UserOperations::countItems())) :?>
								Ваша карзина пустая
								<?php else : ?><span>Кол-во тов. : <b><?=UserOperations::countItems();?></b></span>
							<?php endif; ?>
						</span>
					</a>
				</div>                
            </div>
        </div>
    </header>
    </div>
	<nav class="nav">
		<div class="container menu-container">
			<div class="menu">
				<?php new \app\widgets\menu\Menu([
                        'tpl' => $_SERVER['DOCUMENT_ROOT'] . '/app/web/menu/menu.php',
                    ]); ?>
			</div>
		</div>
		<div class="clearfix"> </div>
    </nav>
    <div class="contents container">
        <?=$content;?>
    </div>
	<div class="container case">
		<div class="case_bin">
			<div class="bin" style="background-color:#318d36;">
				<p>ДОСТУПНАЯ</p><p>ЦЕНА</p>
			</div>
		</div>
		<div class="case_bin">
			<div class="bin" style="background-color:#6aae37;">
				<p>ВЫСОКИЙ</p><p>СЕРВИС</p></p>
			</div>
		</div>
		<div class="case_bin">
			<div class="bin" style="background-color:#9fcd39;">
				<p>ДОСТАВКА</p><p>ПО РОССИИ</p>
			</div>
		</div>		
	</div>
	
    <footer class="footer">
        <div class="container footer-information">
            <div class="footer_item">
                <div class="line">
                    <p>КАТАЛОГ</p>
                    <hr>
                </div>
                <ul>
                    <li><a href="#">Луковичные</a></li>
                    <li><a href="#">Многолетники</a></li>
                    <li><a href="#">Декоративные кустарники</a></li>
                    <li><a href="#">Хвойные</a></li>
                    <li><a href="#">Розы</a></li>
                    <li><a href="#">Плодовые</a></li>
                    <li><a href="#">Cопутствующие товары</a></li>
                </ul>
            </div>
            <div class="footer_item">
                <div class="line">
                    <p>ИНФОРМАЦИЯ</p>
                    <hr>
                </div>
                <ul>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">Условия работы</a></li>
                    <li><a href="#">Отзывы</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Статьи</a></li>
                </ul>
            </div>
            <div class="footer_item">
                <div class="line">
                    <p>КОНТАКТЫ</p>
                    <hr>
                </div>
                <ul>
                    <li><a href="#">Телефон: +7(978)911-22-92</a></li>
                    <li><a href="#">Режим работы<br>по телефону: пн-пт 9:00-17:00<br>on-line: круглосуточно</a></li>
                    <li><a href="#">E-mail: info@flowers-island.ru</a></li>
                    <li><a href="#">Адрес: 298600, Россия, Крым, Ялта,<br>п. Высокогорное, ул. Лесная 9а</a></li>
                </ul>
            </div>
            <div class="footer_item">
                <div class="line">
                    <p>ПРИСОЕДИНЯЙСЯ К НАМ</p>
                    <hr>
                </div>
                <div class="toils">
                    <div class="touch"><a href="#"><img src="/app/web/images/exposure.png"></a></div>
                    <div class="group"><a href="#"><img src="/app/web/images/vk.png"></a></div>
                </div>
            </div>
        </div>
    </footer>
	<div  class="footer_block">
		<div class="container permission">
			<div class="copyright">	
				<p>© Интернет-магазин саженцев цветов и растений для сада «Остров цветов», 2015 - 2020.</p> 
			</div>
			<div class="copyright">
				<a href="#">Пользовательское соглашение</a>
				<a href="#">Политика конфиденциальности</a>
			</div>	
		</div>
	</div>
    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<script src="/app/web/js/script.js"></script>
	<script src="/app/web/js/jquery.easydropdown.js"></script>
	<script src="/app/web/megamenu/js/megamenu.js"></script>
	<script src="/app/web/js/main.js"></script>
	<!--<script src="js/imagezoom.js"></script>-->
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
		});
		});
	</script>
    </div>
</body>
</html>