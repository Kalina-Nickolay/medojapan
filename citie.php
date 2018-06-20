<div>
	<div class="grid-container ">
		<div class="grid-x grid-padding-x align-center ">
			<?
				$index = $_GET["index"];
				
				if($index=="new_citie")
				{
					echo
					'			
					<form action="index.php?page=c" method="POST" >
					<select name="choice_client">
					
					<div class="column small-12 medium-6 large-4">
						<div class="container" >
							<div class="container__wrapper" style="margin:5%;">
								
									<a href="index.php?page=citie&index='.$id_citie.'" >
										<div class="container__content vertical-middle-front hauberk">
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
				else
				{
					$stmt = $db->query("SELECT * FROM cities WHERE id='$index'");
					$row = $stmt->fetch();
					$id_citie=$index;
					$name_citie=$row['name_citie'];
					$description_citie=$row['description_citie'];
					$avatar_citie=$row['avatar_citie'];	
					echo
					'
					<div class="column small-12 medium-12 large-12">
						<div class="container">
							<div class="container__wrapper">
								<div class="container__content vertical-middle-front hauberk" style="">
									<img class="" src="../img/cities/'.$id_citie.'/'.$avatar_citie.'"></img>
									
									<div class="hauberk_text">
										<span>
										'.$name_citie.'
										</span>
									</div>
									<div>
										<p>'.$description.'</p>
									</div>
									
									<div class="fotorama" 
									data-nav="thumbs" data-shuffle="true" data-shuffle="true" data-allowfullscreen="true">
									';
									$stmt1 = $db->query("SELECT * FROM cities_images WHERE id_citie='$index'");
									while ($row1 = $stmt1->fetch())
									{
										
										$id=$row1['id'];
										$name_image=$row1['name_image'];
										$description_image=$row1['description_image'];
										
										echo
										'
											<img class="" src="../img/cities/'.$id_citie.'/citie_images/'.$name_image.'"></img>
										';
									}
									echo
									'
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					';
					if($ROLE_SESSION=='admin' || $ROLE_SESSION=='expert')
					{
					?>
					<div style="text-align:center">
					
						<?
								echo
								'
									<form name="application" enctype="multipart/form-data" action="index.php?page=citie&index='.$index.'" method="post"> 
									<input  type="hidden"  value="'.$index.'" name="id_citie"></input>
								';
							?>
						<input name="file" type="file" />
						<input type="submit" name="file_i" value="Send File" />
					</form>
					</div>		
						<?
					}
				}
			?>
		</div>
	</div>
</div>