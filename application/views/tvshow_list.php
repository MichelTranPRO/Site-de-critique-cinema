<h6>Liste des séries</h6>
<section class="list">
<?php

foreach($tvshow as $show){
	echo "<article>";
	echo "<header class='short-text'>";
	echo anchor("Tvshow_serie/id/".$show->id,"{$show->name}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($show->jpeg).'" alt="image série">';
	echo "<footer class='short-text'>{$show->nb} saisons</footer>";
	echo "</article>";
}
?>
</section>
