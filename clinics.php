<?
/*
 * Клиники
 */
?>
<div class="content_background">
	<div class="grid-container " >
		<div class="grid-x grid-padding-x align-center ">
			<?
			$stmt = $db->query('SELECT * FROM clinics');
			while ($row = $stmt->fetch())
			{
				$id_clinic=$row['id'];
				$id_citie=$row['id_citie'];
				$name_clinic=$row['name_clinic'];
				$description_clinic=$row['description_clinic'];
				$link_clinic=$row['link_clinic'];
				$avatar_clinic=$row['avatar_clinic'];	
				echo
				'
				<div class="column small-12 medium-6 large-4">
					<div class="container" >
						<div class="container__wrapper" style="margin:5%;">
							<a href="index.php?page=citie&index='.$id_clinic.'" >
								<div class="container__content vertical-middle-front hauberk hauberk_border">
									<img class="hauberk_image" src="../img/cities/'.$id_clinic.'/'.$avatar_clinic.'">
									<div class="hauberk_text">
										'.$name_clinic.'
									</div>
									</img>
								</div>
							</a>
						</div>
					</div>
				</div>
				';
				
			}
			?>
			
		</div>
	</div>
</div>