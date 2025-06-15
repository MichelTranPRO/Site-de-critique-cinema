<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="<?= base_url('assets/style_page_saison.css') ?>">

<div class="bloc_saison">
    <?php  
    echo '<img src="data:image/jpeg;base64,'.base64_encode($jpeg).'" alt="image serie">';
        echo '<div class="details">';
            echo '<h1>'.$saison.'</h1>';
            echo '<p>'.$nb_episodes.' Episodes</p>';
        echo '</div>';
    echo '</div>';

    echo '<h3>Episodes</h3>';   
    echo '<div class="episodes">';   
    echo '<h4>#</h4>';
    echo '<h4>Titre</h4>';
    echo '<h4>Description</h4>';                                                                                                                             
    foreach ($episodes as $ep){                                                                                                                                   
        echo '<p class="nb_ep">'.$ep['ep_number'].'</p>';
        echo '<p class="titre">'.$ep['name'].'</p>';
        if(empty($ep['description'])){
            echo '<p class="description">Pas de description. </p>';
        }
        else{
            echo '<p class="description">'.$ep['description'].'</p>';
        }
    }
    echo '</div>';
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
                			echo '★'; // étoile pleine
            			} else {
                			echo '☆'; // étoile vide
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
