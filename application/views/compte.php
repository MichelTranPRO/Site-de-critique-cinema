<link rel="stylesheet" href="<?= base_url('assets/style_page_compte.css') ?>">
<div class="bloc_profil">
    <div class="icon_profil"><img src="/~tranm/SAE_WEB_2.02/assets/img/photo_profil.png" alt="photo de profil"></i></div>
    <div class="texte_info">
        <ul>
            <li><h1><?= $_SESSION['prenom']." ". $_SESSION['nom']?></h1></li>
            <li><?= $_SESSION['email']?></li>
        </ul>
    </div>
</div>