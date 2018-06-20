<?
if($ROLE_SESSION=='admin')
{
	
}

if($ROLE_SESSION=='client')
{
?>
	<div class="grid-container " >
		<div class="content_background" id="#application">
			<div class="grid-x grid-padding-x align-center ">
				<div class="column small-12 medium-12 large-12">
					<div class="form">
						<ul class="tab-group">
							<li class="tab active"><a href="#signup">Анкета</a></li>
							<li class="tab"><a href="#chat">Чат</a></li>
						</ul>
						<div class="tab-content">
							<!--
							  -- Личные данные клиента, которые он может изменить, том числе логин и пароль
							  -->
							<div id="signup">   
								<form name="application" action="index.php" method="post"> 
									<div class="field-wrap">
										<input required autocomplete="off" type="text"  placeholder="ФИО" name="full_name"></input>
									</div>
									<div class="top-row">
										<div class="field-wrap">
											<!--
											<label>First Name<span class="req">*</span></label>
											<input type="text" required autocomplete="off" />
											-->
											
											<input required autocomplete="off" type="text" placeholder="Email" name="email"></input>
										</div>
										<div class="field-wrap">
											<!--
											<label>Last Name<span class="req">*</span></label>
											<input type="text"required autocomplete="off"/>
											-->
											<input required autocomplete="off" type="text" placeholder="Телефон" name="phone"></input>
										</div>
									</div>
									<div class="field-wrap">
										<!--
										<label>Email Address<span class="req">*</span></label>
										<input type="email"required autocomplete="off"/>
										-->
										<input required autocomplete="off" type="text" placeholder="Медицинская проблема" name="medical_problem" ></input>
									</div>
									<button type="submit" class="button button-block" name="edit_user_client"/>Изменить</button>
								</form>
							</div>
							<!--
							  -- Чат с экспертом
							  -->
							<div id="chat">   
								<?
									$sql="SELECT * FROM messages WHERE id_client='$ID_SESSION'";
									$stmt = $db->query($sql);
									while ($res = $stmt->fetch())
									{
										$id = $res['id'];
										$id_expert = $res['id_expert'];
										$title = $res['title'];
										$text = $res['text'];
										$date = $res['date'];		
										$time = $res['time'];			
										$sender = $res['sender'];
										if ($sender)
										{
											echo
											'
												<div class="grid-container " >
													<div class="cloudlet_left">
														<p style="padding:10px;">'.$text.'</p>
													</div>
												</div>
											';
										}
										else
										{
											echo
											'
											<div class="cloudlet_left">
												<p style="padding:10px;">'.$text.'</p>
												</div>
											';
										}
									}
								?> 
								<form name="application" action="index.php?page=office&id_user=<?$_SESSION['LOGIN_SESSION'];?>" method="post"> 
									<div style="text-align:center">
									
										
										<label for="uploadbtn" class="uploadButton"><div class="dispatch"><i class="icon-plus"></i></div></label>
										<input style="opacity: 0; z-index: -1;" type="file" name="file" id="uploadbtn">
										
										<?
										echo
										'
										<input  type="hidden"  value="'.$_SESSION['ID_SESSION'].'" name="id_client"></input>

										<input  type="hidden"  value="true" name="sender"></input>
										<input  type="hidden"  value="NULL" name="title"></input>
										<input  type="hidden"  value="NULL" name="'.$id_expert.'"></input>
										';
										?>
										<div style="float:left; width:90%"><input required autocomplete="off"  type="text"  placeholder="Введите сообщение или прикрепите файлы" name="text"></input></div>
										<div class="dispatch"><input type="submit" name="add_message"><i class="icon-comment"></i></input></div>
									</div>
										
								</form>
							</div>
						</div><!-- tab-content -->
					</div> <!-- /form -->
				</div>
			</div>
		</div>
	</div>
<script  src="js/nice_form/index.js"></script>
<?
}

if($ROLE_SESSION=='expert')
{
	/*
	 * Выбор клиента и переход в личный кабинет
	 */
	echo
	'
		<form action="index.php?page=office" method="POST" >
			<select name="choice_client">
			';
			$stmt = $db->query('SELECT * FROM user_client');
			while ($row = $stmt->fetch())
			{
				$full_name=$row['full_name'];
				echo'<option>'.$full_name.'</option>';
			}
			echo
			'
			</select>
		</form>
	';
	/*
	 * Чат с выбранным клиентом
	 */
}
?>