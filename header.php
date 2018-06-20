<!DOCTYPE html>
<html>
<?
	/*
	 * Подключение к базе данных
	 */
	include('db.php');
	/*
	 * Возвращение значений из базы данных
	 */
	include('query.php');
	/*
	 * Запросы к базе данных
	 */
	include('requery.php');
	
	/*
	 * Выключаем ошибки. Теперь сообщений НЕ будет
	 */
	ini_set('display_errors', 'on');
?>


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--Заголовок сайта-->
	<title>Лечение в Японии</title>

	<!--Основные стили сайта-->
	<link rel="stylesheet" href="css/general_style.css">

	<!--Стили меню-->
	<link rel="stylesheet" href="css/menu/menu.css">

	<!--Стили foundation-->
	<link rel="stylesheet" href="css/foundation/foundation.css">
	<!--Скрипты foundation-->
	<script src="js/foundation/vendor/jquery.js"></script>
	<script src="js/foundation/vendor/all-scripts.js"></script>
	<script src="js/foundation/vendor/what-input.js"></script>
	<script src="js/foundation/vendor/foundation.js"></script>
	<script src="js/foundation/app.js"></script>

	<!--responsive multi-level flat menu-->
	<link rel="stylesheet" href="css/responsive_menu/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="font/font-awesome/css/font-awesome.css" >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript" ></script>
	<script src="js/responsive_menu/menu.js" type="text/javascript"></script> 

	<!--videofon-->
	<link rel="stylesheet" href="css/videofon/style.css">

	<!--Красивые формы-->
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/nice_form/style.css">
	
	<!--fotorama-->
	<link href="css/fotorama-4.6.4/fotorama.css" rel="stylesheet">
	<script src="js/fotorama-4.6.4/fotorama.js"></script>
	
	<!--Абсолютный путь-->
	<base target="http://medojapan.esy.es/"> 
</head>
<div class="content_background" style="width:100%; height:100%">
</div>
<div class="order" >

	<a  href="index.php#application">
	<h1>
		<i class="icon-plane">
		</i>
		</h1>
	</a>

</div>

<div class="grid-container " >
			<div class="grid-x grid-padding-x align-center ">
				<div class="column small-0 medium-4 large-4">
				</div>
				<div class="column small-12 medium-4 large-4 header_block_center">
					<img src="img/system/logo.png" class="logo" alt="logo">
				</div>
				<div class="column small-12 medium-4 large-4 header_block_right">
				<?
			
				if (isset($LOGIN_SESSION))
				{
					$category = $ROLE_SESSION;
					$id_user = $ID_SESSION;
					$replace='admin';
					if($category=='client')
					{
						$sql="SELECT full_name FROM user_client WHERE id_user='$id_user'";
						$stmt = $db->query($sql);
						$res1 = $stmt->fetch();
						$replace = $res1['full_name'];	
					}
					if($category=='expert')
					{
						$sql="SELECT full_name FROM user_expert WHERE id_user='$id_user'";
						$stmt = $db->query($sql);
						$res2 = $stmt->fetch();
						$replace = $res2['full_name'];	
					}
					echo
					'
				
				
					<ul class="menu">
					<li><a class="login">'.$replace.'</a>
						<ul class="sub_menu_dropout">
							';
							if($_SESSION['ROLE_SESSION']!='admin')
							{
								echo'
									<li>
										<a href="index.php?page=office&id_user='.$id_user.'">Личный кабинет</a>
									</li>
								';
							}
							echo'
							<li>
							<!--ATTENTION АТЕНШН НЕ С ПЕРВОГО РАЗА РАБОТАЕТ-->
								<form action="index.php" method="POST">
								<a>
									<button type="submit" name="out">Выйти</button>
								</a>
								</form>
							</li>
						</ul>
					</li>
					</ul>
					
					
					';
					
				}
				
				else
				{
					echo
					'
					<button type="submit" class="popup login" iddiv="box_1">Вход</button>
					';
				}
				?>
				</div>
			</div>
		</div>
<div class="fullscreen-bg">
	<div class="overlay">
		
	</div>
	<video loop muted autoplay poster="img/videofon/overcast.jpg" class="fullscreen-bg__video" >
		<source src="video/videofon/overcast.mp4" type="video/mp4">
	</video>
</div>
	

	
<!-- Всплывающее окно авторизации (форма и скрипт) -->
<div id="popupwindow" opendiv=""></div>
<div id="box_1" class="mymagicoverbox_fenetre">
	<?
	/*
	 * Вход в систему
	 */	
	?>
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center ">
			<div class="column small-12 medium-6 large-6">
				<form name="login" action="index.php" class="form" method="post" action="">
					<div class="field-wrap">
						<input required type="text"  placeholder="Логин" name="login"></input>
					</div>
					<div class="field-wrap">
						<input required type="text" placeholder="Пароль" name="password"></input>
					</div>
					<button type="submit" class="button button-block" name="in"/>Войти</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".popup").click(function(){
		$('#popupwindow').fadeIn(300);
		var iddiv = $(this).attr("iddiv");
		$('#'+iddiv).fadeIn(300);
		$('#popupwindow').attr('opendiv',iddiv);
		return false;
	});
	 
	$('#popupwindow, .mymagicoverbox_fermer').click(function(){
		var iddiv = $("#popupwindow").attr('opendiv');
		$(popupwindow).fadeOut(300);
		$('#'+iddiv).fadeOut(300);
	});
});
</script>