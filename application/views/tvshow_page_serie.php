<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="<?= base_url('assets/style_page_details.css') ?>">

<div class="bloc_info">
	<?php
	echo '<img src="data:image/jpeg;base64,'.base64_encode($tvshow->jpeg).'" alt="image série">';
	echo '<div class="details">'; // debut div details
		echo '<h1>'. $tvshow->name. '</h1>';
		echo '<div class="genre">'; // debut div genre
			foreach ($genre as $g){
				echo '<div class="genre_items">'. $g->genres. '</div>';
			}
		echo '</div>'; // fin div genre
		echo '<h4><i class="fas fa-file-lines"></i> Synopsis</h4>';
		echo '<p>'. $tvshow->overview. '</p>';
		echo '<a href="'.$tvshow->homepage .'">Site officiel</a>';
	echo '</div>'; // fin div details
	?>
</div>

<?php echo '<h1 class =txt_saison> '. $tvshow->nbSaisons. ' Saisons</h1>'; ?>

<div class="bloc_saisons">
	<?php
	
	foreach ($saisonEtEpisode as $nomSaison => $episodes){
		echo '<article>';
		echo "<header class='short-text'>";
		echo anchor("Tvshow_saison/saisonId/".$episodes[0]['saisonId'], "{$nomSaison}");
		echo "</header>";
		echo '<img src="data:image/jpeg;base64,'.base64_encode($episodes[0]['jpeg_saison']).'" alt="image saison">';
		echo '</article>';
	}
	?>
</div>

<div class="texte_haut">
<?php 
echo '<h1>Donnez votre avis !</h1>';
if($message !== null){
    echo "<div class=erreur>".htmlspecialchars($message)."</div>";
}
echo '</div>';
echo '<form action="" method="POST">';
	echo '<div class="texte_milieu">';
		echo '<div class="titre_avis">';
			echo '<div class="titre"><h5><label for="titre">Titre</label></h5><input id="titre" name="titre" type="text" size="30" required placeholder="Entrez votre titre...">';
			echo '</div>';
			echo '<div class="avis_note"><h5><label for="avis">Avis</label></h5><input id="avis" name="avis" type="number" min="0" max="5">';
			echo '</div>';
		echo '</div>';
		echo '<h5><label for="description">Description</label></h5>';
		echo '<textarea name="description" id="description" cols="30" rows="10" placeholder="Entrez votre description..."></textarea>';
		echo '<input id="envoyer" name="envoyer" type="submit" value="Envoyer">';
	echo '</div>';
echo '</form>';

if (!empty($avis)){
    echo "<h1 class=txt_avis>Avis</h1> ";
    echo '<div class="bloc_avis">';
	foreach ($avis as $row){

		echo '<div class="contenu">';
        	echo '<div class="personne">';
                echo '<img src="/~tranm/SAE_WEB_2.02/assets/img/photo_profil.png" alt="photo de profil">';
                echo '<h1>'.$row->prenom.' '.$row->nom.'</h1>';
            echo '</div>';
            echo '<ul class="avis">';
                echo '<li class="note">';
				$note = $row->note;
        			for ($i = 1; $i <= 5; $i++) {
            			if ($i <= $note) {
                			echo '★';
            			} else {
                			echo '☆';
            			}
        			}
				echo '</li>';
                echo '<li class="titre"><h2>'.$row->titre.'</h2></li>';
                echo '<li class="description">'.$row->description.'</li>';
            echo '</ul></div>';
	}
}
else{
    echo "<h1 class=txt_avis>Pas encore d'avis</h1> ";
}?>
</div>