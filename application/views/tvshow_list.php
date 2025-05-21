<h6>Liste des ça marche pas ptn</h6>
<section class="list">
<?php

foreach($tvshow as $show){
	echo "<article>";
	echo "<header class='short-text'>";
	echo anchor("","{$show->name}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($show->jpeg).'" />';
	echo "<footer class='short-text'>{$show->nb} saisons</footer>";
	echo "</article>";
}
?>
</section>
