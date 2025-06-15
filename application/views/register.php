<link rel="stylesheet" href="<?= base_url('assets/style_page_login.css') ?>">
<div class="bloc_login">
    <div class="texte_haut">
        <h1>S'inscrire</h1>
    </div>
    <form action="" method="POST"> 
    <div class="texte_milieu">
        <h5>Information personnelles</h5>
        <label for="prenom"></label>
        <input id="prenom" name="prenom" type="text" size="30" required="" placeholder="Entrez votre prénom..." 
        <?php if(isset($prenom)){
            echo 'value="'.htmlspecialchars($prenom).'"';
        }?>> 
        <label for="nom"></label>
        <input id="nom" name="nom" type="text" size="30" required="" placeholder="Entrez votre nom..."
        <?php if(isset($nom)){
            echo 'value="'.htmlspecialchars($nom).'"';
        }?>>
        <h5>Sécurité du compte</h5>
        <label for="email"></label>
        <input id="email" name="email" type="email" size="30" required="" placeholder="Entrez votre mail..."/>
        <?php if(isset($message)){
            echo "<div class=erreur>".htmlspecialchars($message['erreur_email'])."</div>";
        } ?>
        <label for="mdp"></label>
        <input id="mdp" name="mdp" type="password" size="30" required="" placeholder="Entrez votre mot de passe..."/>
        <?php
        echo "<p>Tu as déjà compte ? ";
        echo anchor("user/login", "Connexion");
        echo "</p>";
        ?>
        <input id="envoyer" name="envoyer" type="submit" value="Envoyer"/>
    </div>
    </form>
</div>