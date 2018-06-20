<?
/*
 * Видео на фоне
 */
?>
<!--

-->
<?
/*
 * 
 */
?>
<div class="content_background" >
<div class="">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center ">
			<div class="column small-12 medium-12 large-12">
				<h1>Лечение в японии с нами - отличный сервис, лучшая медицина, незабываемый отдых</h1>
			</div>
			
			<div class="column small-12 medium-4 large-4">
				<h2>Лучшие медицинские учреждения</h2>
			</div>
			<div class="column small-12 medium-4 large-4">
				<h2>Великолепные гиды</h2>
			</div>
			<div class="column small-12 medium-4 large-4">
				<h2>Незабываемый отдых</h2>
			</div>
		</div>
	</div>
</div>
<style>
	#map 
	{
		height: 400px;
		width: 100%;
	}
</style>
	
<div id="map"></div>
<?
$names_cities = array();
$descriptions_cities = array();
$avatars_cities = array();
$lats = array();
$lngs = array();



?>


<script>
	function initMap() 
	{
		var map = new google.maps.Map(document.getElementById('map'), 
		{
		  zoom: 6,
		  center: new google.maps.LatLng(35.737738, 137.936153),
		  mapTypeId: 'roadmap'
		});
		setMarkers(map);
	}
	
	var names_cities_js = <?php echo $names_cities_php;?>;
	var descriptions_cities_js = <?php echo $descriptions_cities_php;?>;
	var avatars_cities_js = <?php echo $avatars_cities_php;?>;
	var lats_js = <?php echo $lats_php;?>;
	var lngs_js = <?php echo $lngs_php;?>;

	var cities=[];
	for (var i = 0; i < names_cities_js.length; i++) {
		cities[i]=[names_cities_js[i],  lats_js[i], lngs_js[i], i+1]
	}
  

	function setMarkers(map) {
	  var image = {
		url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
		// This marker is 20 pixels wide by 32 pixels high.
		size: new google.maps.Size(20, 32),
		// The origin for this image is (0, 0).
		origin: new google.maps.Point(0, 0),
		// The anchor for this image is the base of the flagpole at (0, 32).
		anchor: new google.maps.Point(0, 32)
	  };
	  // Shapes define the clickable region of the icon. The type defines an HTML
	  // <area> element 'poly' which traces out a polygon as a series of X,Y points.
	  // The final coordinate closes the poly by connecting to the first coordinate.
	  var shape = {
		coords: [1, 1, 1, 20, 18, 20, 18, 1],
		type: 'poly'
	  };
	  for (var i = 0; i < cities.length; i++) {
		var citie = cities[i];
		var marker = new google.maps.Marker({
		  position: {lat: citie[1], lng: citie[2]},
		  map: map,
		  icon: image,
		  shape: shape,
		  title: citie[0],
		  zIndex: citie[3]
		});
	  }
	}
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK9J8E-WT7muiC2FWXJYJ9gkUAFDD7Gnk&callback=initMap">
</script>

<div class="" id="application">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center ">
			<div class="column small-12 medium-12 large-12">
				<div class="form">
					<ul class="tab-group">
						<li class="tab active"><a href="#signup">Задать вопрос</a></li>
						<li class="tab"><a href="#login">Заказать путевку</a></li>
					</ul>
					<?
						$full_name=NULL;
						$medical_problem = NULL;
						$phone = NULL;
						$email = NULL;
						
						if ($ROLE_SESSION=="client")
						{
							
							$sql="SELECT * FROM user_client WHERE id_user='$ID_SESSION'";
							$stmt = $db->query($sql);
							$res = $stmt->fetch();
							$full_name = 'value='.$res['full_name'];	
							$medical_problem =  'value='.$res['medical_problem'];
							$phone =  'value='.$res['phone'];
							$email =  'value='.$res['email'];
						}
					echo
					'
					<div class="tab-content">
						<div id="signup">   
							<h1>Задайте экспертам вопрос</h1>
							<form name="application" action="index.php" method="post"> 
								<div class="field-wrap">
									<input required autocomplete="off" type="text" '.$full_name.' placeholder="ФИО" name="full_name"></input>
								</div>
								<div class="top-row">
									<div class="field-wrap">
										<!--
										<label>First Name<span class="req">*</span></label>
										<input type="text" required autocomplete="off" />
										-->
										
										<input required autocomplete="off" type="text" '.$email.' placeholder="Email" name="email"></input>
									</div>
									<div class="field-wrap">
										<!--
										<label>Last Name<span class="req">*</span></label>
										<input type="text"required autocomplete="off"/>
										-->
										<input required autocomplete="off" type="text" '.$phone.' placeholder="Телефон" name="phone"></input>
									</div>
								</div>
								<div class="field-wrap">
									<!--
									<label>Email Address<span class="req">*</span></label>
									<input type="email"required autocomplete="off"/>
									-->
									<input required autocomplete="off" type="text" placeholder="Медицинская проблема" name="medical_problem" ></input>
								</div>
								<button type="submit" class="button button-block" name="in"/>Отправить</button>
							</form>
						</div>
						
						<div id="login">   
							<h1>Вы готовы к поездке?</h1>
							<form action="/" method="post">
								
										<div class="field-wrap">
											<input required autocomplete="off" type="text" '.$full_name.' placeholder="ФИО" name="full_name"></input>
										</div>
										<div class="top-row">
											<div class="field-wrap">
												<!--
												<label>First Name<span class="req">*</span></label>
												<input type="text" required autocomplete="off" />
												-->
												
												<input required autocomplete="off" type="text" '.$email.' placeholder="Email" name="email"></input>
											</div>
											<div class="field-wrap">
												<!--
												<label>Last Name<span class="req">*</span></label>
												<input type="text"required autocomplete="off"/>
												-->
												<input required autocomplete="off" type="text" '.$phone.' placeholder="Телефон" name="phone"></input>
											</div>
										</div>
										<div class="field-wrap">
											<!--
											<label>Email Address<span class="req">*</span></label>
											<input type="email"required autocomplete="off"/>
											-->
											<input required autocomplete="off" type="text" '.$medical_problem.' placeholder="Медицинская проблема" name="medical_problem" ></input>
										</div>
							
								<div class="top-row">
									<div class="field-wrap">
										<!--
										<label>First Name<span class="req">*</span></label>
										<input type="text" required autocomplete="off" />
										-->
										<select required autocomplete="off" type="text" placeholder="Город" name="citie">
										';
											$stmt = $db->query('SELECT * FROM cities');
											while ($row = $stmt->fetch())
											{
												$id=$row['id'];
												$name_citie=$row['name_citie'];
												echo'<option>'.$name_citie.'</option>';
											}
					?>
										</select>
										
									</div>
									<div class="field-wrap">
										<!--
										<label>Last Name<span class="req">*</span></label>
										<input type="text"required autocomplete="off"/>
										-->
										<select required autocomplete="off" type="text" placeholder="Клиника" name="clinic">
										<?	
											$stmt = $db->query('SELECT * FROM clinics');
											while ($row = $stmt->fetch())
											{
												$id=$row['id'];
												$name_clinics=$row['name_clinics'];
												echo'<option>'.$name_clinics.'</option>';
											}
										?>
										</select>
										
									</div>
								</div>
								<button class="button button-block"/>Поехали</button>
							</form>
						</div>
					</div><!-- tab-content -->
				</div> <!-- /form -->
			</div>
		</div>
	</div>
</div>
</div>
<?
/*
 * Почему-то работает только если это находится здесь. В хидер не класть. 
 */
?>
			
<script  src="js/nice_form/index.js"></script>