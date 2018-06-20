<?
	$_SERVER["REQUEST_URI"]= $_SERVER["REQUEST_URI"];
	/*
	 * Старт сессии
	 */
	session_start();
	/*
	 * Вытаскиваем/назвачаем роли
	 */
	$ID_SESSION = $_SESSION["ID_SESSION"];
	$LOGIN_SESSION = $_SESSION['LOGIN_SESSION'];
	$ROLE_SESSION = $_SESSION['ROLE_SESSION'];
	
	/*
	 * импортируем хидер
	 */
	include('header.php');
	/*
	 * импортируем меню сайта
	 */
	include('menu.php');
	/*
	 * импортируем тело сайта, иклюжим страницу, указанную в пост переменной page, если она, конечно, существует
	 */
	$page = $_GET["page"].'.php';
	if (file_exists(dirname(__FILE__) . '\\'.$page))
		include(dirname(__FILE__) . '\\'.$page);
	else
		include('main.php');
	/*
	 * импортируем футер
	 */
	include('footer.php');

?>