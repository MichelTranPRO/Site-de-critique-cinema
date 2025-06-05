<link rel="stylesheet" href="<?= base_url('assets/style_page_saison.css') ?>">

<div class="bloc_saison">
    <?php  
    echo '<img src="data:image/jpeg;base64,'.base64_encode($jpeg).'" />';
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
