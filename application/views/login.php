<link rel="stylesheet" href="<?= base_url('assets/style_page_login.css') ?>">
<div class="bloc_login">
    <div class="texte_haut">
        <h1>Se connecter</h1>
    </div>
    <form action="" method="POST"> 
    <div class="texte_milieu">
        
        <h5><label for="email"></label></h5>
        <input id="email" name="email"type="email" size="30" required="" placeholder="Entrez votre mail..." 
        <?php if(!empty($email)){
            echo 'value="'.htmlspecialchars($email).'"';
        }
        ?>/>

        <?php if(!empty($message['erreur_email'])){
            echo "<div class=erreur>".htmlspecialchars($message['erreur_email'])."</div>";
            }?>
        <h5><label for="mdp"></label></h5>
        <input id="mdp" name="mdp" type="password" size="30" required="" placeholder="Entrez votre mot de passe..."/>
        <?php
        if(!empty($email)){
            echo "<div class=erreur>".htmlspecialchars($message['erreur_mdp'])."</div>";
        }
        ?>
        <?php
        echo "<p>Tu n'as encore de compte ? ";
        echo anchor("user/register", "Inscription");
        echo "</p>";
        ?>
        <input id="envoyer" name="envoyer" type="submit" value="Envoyer"/>
    </div>
</div>