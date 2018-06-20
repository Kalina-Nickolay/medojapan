<?
/*
 * Города
 */
?>
<div class="content_background">
	<div class="grid-container " >
		<div class="grid-x grid-padding-x align-center ">
			<?
			$stmt = $db->query('SELECT * FROM cities');
			while ($row = $stmt->fetch())
			{
				$id_citie=$row['id'];
				$name_citie=$row['name_citie'];
				$description_citie=$row['description_citie'];
				$avatar_citie=$row['avatar_citie'];	
				echo
				'
				<div class="column small-12 medium-6 large-4">
					<div class="container" >
						<div class="container__wrapper" style="margin:5%;">
							
								<a href="index.php?page=citie&index='.$id_citie.'" >
									<div class="container__content vertical-middle-front hauberk hauberk_border">
										<img class="hauberk_image" src="../img/cities/'.$id_citie.'/'.$avatar_citie.'">
										<div class="hauberk_text">
											'.$name_citie.'
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