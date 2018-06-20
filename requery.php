<?
	/*
	 * Вход в систему
	 */
	if(isset($_POST['in']))
		{
		
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		/*
		 * Проверка на существование такого пользователя
		 */
		$sql="SELECT id, login, password, category FROM users WHERE login='$login'";
		$stmt = $db->query($sql);
		$res = $stmt->fetch();
		if (!isset($res))
		{
			?> 
			<script>
				alert("Неверный логин");
			</script> 
			<?
		}
		else 
		{
			if ($res['password']!=md5($password)) 
			{
				?> 
				<script>
					alert("Неверный пароль");
				</script>
				<?
			}
			else 
			{
				
				$_SESSION['ID_SESSION']=$res['id'];
				$_SESSION['LOGIN_SESSION']=$res['login'];
				$_SESSION['ROLE_SESSION']=$res['category'];
				
				$ID_SESSION = $_GET["ID_SESSION"];
				$LOGIN_SESSION = $_SESSION['LOGIN_SESSION'];
				$ROLE_SESSION = $_SESSION['ROLE_SESSION'];
			}
		}
	}
	
	/*
	 * Изменение анкеты клиента
	 */
	if(isset($_POST['edit_user_client']))
	{
		
	}
	
	/*
	 * Изменение анкеты специалиста
	 */
	if(isset($_POST['edit_user_expert']))
	{
		
	}
	
	/*
	 * Добавление сообщения в базу
	 */
	if(isset($_POST['add_message']))
	{
		$id_client = $_POST['id_client'];
		$id_expert = $_POST['id_expert'];
		$title = $_POST['title'];
		$text = $_POST['text'];
		$date =date("Y-m-d");
		$time = date("H:i:s");
		
		$stmt = $db->prepare("INSERT INTO messages (id_user, id_expert, title, text, date, time) VALUES ($id_user, $id_expert, $title, $text, $date, $time)");
		$stmt->bindParam(':id_user', $id_user);
		$stmt->bindParam(':id_expert', $id_expert);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':text', $text);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':time', $time);
		$stmt->execute();
		
		$sql="SELECT id FROM messages ORDER BY ID DESC LIMIT 1"; // Достаем айди последней записи в таблице сообщений, чтобы записать файлы к нему
		$stmt = $db->query($sql);
		$res = $stmt->fetch();
		$id_message=$res['id'];
										

		if (empty($_FILES['file']))
		{
			$upload_path = './msg/'.$id_client.'/'; // Директория на сервере, в которую жахнем файл
			move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . basename($_FILES['file']['name'])); // Перемещаем файл в желаемую директорию
			if(mb_strlen($_FILES['file']['type'])>2)
			{
				$image_file_name = basename($_FILES['file']['name']); // Изголяемся, создавая имя файлу
				$stmt = $db->prepare("INSERT INTO messages_docs (id_message, name_doc, type_doc) VALUES (:id_message,:name_doc,:type_doc)");
				$stmt->bindParam(':id_message', $id_message);
				$stmt->bindParam(':name_doc', $name_doc);
				$stmt->bindParam(':type_doc', $type_doc);
				$stmt->execute();
			}
		}
	}
	
	if(isset($_POST['file_i']))
	{
		$id_citie = $_POST['id_citie'];

		if (!empty($_FILES['file']))
		{
				$upload_path = './img/cities/'.$id_citie.'/citie_images/'; // Директория на сервере, в которую жахнем картинку
		
				move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . basename($_FILES['file']['name'])); // Перемещаем файл в желаемую директорию
		
				$image_file_name =  basename($_FILES['file']['name']);
				$stmt = $db->prepare("INSERT INTO cities_images (id_citie, name_image,description_image) VALUES (:id_citie,:name_image,:description_image)");
				$stmt->bindParam(':id_citie', $id_citie);
				$stmt->bindParam(':name_image', $image_file_name);
				$stmt->bindParam(':description_image', $id_citie);
				$stmt->execute();
		}
	}
	
	/*
	 * Удаление сообщения из базы
	 */
	if(isset($_POST['delete_message']))
	{
		$id= $_POST['id'];
		$sql="DELETE FROM message WHERE id = '$id'";
		$stmt->execute();
	}
	
	/*
	 * Выход из системы
	 */
	if(isset($_POST['out']))
	{
		unset($_SESSION['ID_SESSION']);
		unset($_SESSION['LOGIN_SESSION']);
		unset($_SESSION['ROLE_SESSION']);
	}
	
	/*
	 * Заявка на лечение
	 */
	if(isset($_POST['application']))
	{
		$full_name = $_POST['full_name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$medical_problem = $_POST['medical_problem'];
		?> 
			<script>
				alert("Логин и пароль высланы вам на почту");
			</script>
		<?
		
		/*
		 * Отправляем оповещение экспертам
		 */
		$message = " ФИО: " . $full_name . "\r\n Телефон: " . $phone ."\r\n Медицинская проблема: " . $medical_problem;
		mail('MEDOJAPANGO@gmail.com', 'RE: LJAPAN', $message);
		
		/*
		 * Создаем пароль и отправляем логин и пароль пользователю
		 */
		 
		/*СОЗДАТЬ ПРОВЕРКУ НА НАЛИЧИЕ ТАКОГО ПОЧТОВОГО ЯЩИКА В СИСТЕМЕ*/
		
		/* Символы, которые будут использоваться в пароле */
		$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
		/* Количество символов в пароле */
		$max=10; 
		/* Определяем количество символов в $chars*/
		$size=StrLen($chars)-1; 
		/* Определяем пустую переменную, в которую и будем записывать символы */
		$password=null; 
		// Создаём пароль. 
		while($max--) 
			$password.=$chars[rand(0,$size)]; 
		
		$login = 'admin';
		/*$password = $_POST['NUMBER'];*/
		$FIO = $_POST['full_name'];
		$message =  $FIO . " Ваш логин и пароль для входа в личный кабинет на сайте **** \r\n Логин: " . $login . "\r\n Пароль: " . $password;
		mail($email, 'RE: LJAPAN', $message);
		
		/*
		 * Добавляем пользователя в базу данных
		 */
		$password=md5($password);
		$stmt = $db->prepare("INSERT INTO users(`login`,`password`,`category`) 
		VALUES (:login,:password,:category)");	
		$stmt->bindParam(':name_text', $login);       
		$stmt->bindParam(':block_text', $password);
		$stmt->bindParam(':music_text', 'client');	
		$stmt->execute(); 
	
		/*
		 * Осуществляем первичный вход в систему после регистрации
		 */
		$_SESSION['ID_SESSION']=$login;
		$_SESSION['LOGIN_SESSION']=$password;
		$_SESSION['ROLE_SESSION']='client';
		
		$ID_SESSION = $_GET["ID_SESSION"];
		$LOGIN_SESSION = $_SESSION['LOGIN_SESSION'];
		$ROLE_SESSION = $_SESSION['ROLE_SESSION'];
	}
?>