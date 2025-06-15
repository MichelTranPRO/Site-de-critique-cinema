<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>SERIES</title>
		<link
	  rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
   />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<?=link_tag('assets/style.css')?>
	</head>
	<body>
		<main class='container'>
			<nav>
				<ul>
					<li><strong>Séries</strong></li>
					<li><a href="/~tranm/SAE_WEB_2.02/"><i class="fas fa-home"></i></a></li>
					<li><?= anchor("user/login", '<i class="fas fa-user"></i>') ?></li>
					<li><?php if (isset($_SESSION['connection']) && $_SESSION['connection']){echo anchor("user/logout", '<i class="fa-solid fa-right-from-bracket"></i>');} ?></li>
				</ul>
				<ul>
					<li>
						<form method="GET" action="<?=site_url('tvshow');?>" role="search">
							<select name="type" aria-label="Type">
								<option selected disabled value="">Genre</option>
								<option value="1">Action & Adventure</option>
								<option value="2">Crime</option>
								<option value="3">Drame</option>
								<option value="4">Comédie</option>
								<option value="5">Science-Fiction & Fantastique</option>
								<option value="6">Mystère</option>
								<option value="7">Western</option>
								<option value="8">War & Politics</option>
								<option value="9">Familial</option>
								<option value="10">Animation</option>
								<option value="11">Romance</option>
								<!-- A la base j'avais fais ce code mais les genres s'affichaient que sur la page d'accueil
								<?php 
								/**foreach ($genre as $row){
									echo '<option value="'.$row->genreId.'">'.$row->name.'</option>';
								} */
								?>
								-->
							</select>
							<input name="search" type="search" placeholder="Search" />
							<input type="submit" value="Search" />
						</form>
					</li>
				</ul>
			</nav>
