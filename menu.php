<?
/*
 * Всё, что над меню
 */
 
/*
 * Меню
 */
?>	
<div class="menu_case">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<div class="column small-12 medium-12 large-12">
				 <a id="touch-menu" class="mobile-menu" href="#"><i class="icon-reorder"></i>Menu</a>
				 <div class="">
					 <nav>
						<ul class="menu">
							<li><a href="index.php"><i class="icon-home"></i>Главная</a></li>
							<li><a  href="index.php?page=cities"><i class="icon-building"></i>Города</a>
								<ul class="sub-menu">
									<?
									$stmt = $db->query('SELECT * FROM cities');
									while ($row = $stmt->fetch())
									{
										$id_citie=$row['id'];
										$name_citie=$row['name_citie'];
										echo
										'
										<li><a href="index.php?page=citie&index='.$id_citie.'">'.$name_citie.'</a></li>
										';
									}
									?>
								</ul>
							</li>
							<li><a  href="index.php?page=clinics"><i class="icon-hospital"></i>Клиники</a>
								<ul class="sub-menu">
									<?
									$stmt = $db->query('SELECT * FROM clinics');
									while ($row = $stmt->fetch())
									{
										$id_clinic=$row['id'];
										$name_clinic=$row['name_clinic'];
										echo
										'
										<li><a href="index.php?page=clinic&index='.$id_clinic.'">'.$name_clinic.'</a></li>
										';
									}
									?>
								</ul>
							</li>
							<li><a  href="index.php?page=directions"><i class="icon-file-alt"></i>Направления</a>
								<ul class="sub-menu">
									<?
									/*$stmt = $db->query('SELECT * FROM directions');
									while ($row = $stmt->fetch())
									{
										$id_direction=$row['id'];
										$title_direction=$row['title_direction'];
										echo
										'
										<li><a href="index.php?page=citie&index='.$id_direction.'">'.$title_direction.'</a></li>
										';
									}*/
									?>
								</ul>
							</li>
							<li><a  href="index.php#application"><i class="icon-plane"></i>Заказать</a></li>
							<li><a  href="index.php?page=contacts"><i class="icon-phone"></i>Контакты</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>