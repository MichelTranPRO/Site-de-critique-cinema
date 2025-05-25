<?=link_tag('assets/style_page_details.css')?> 
<div class="bloc_info">
	<?php
	echo '<img src="data:image/jpeg;base64,'.base64_encode($tvshow->jpeg).'" />';
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
	echo '</div>' // fin div details
	?>
</div>

<div class="bloc_saisons">
	<?php
	echo '<h1> '. $tvshow->nbSaisons. ' Saisons</h1>';
	?>
</div>