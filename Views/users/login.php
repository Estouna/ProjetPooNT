<h1 class="text-primary text-center mb-5">Connexion</h1>

<!-- 
    -------------------------------------------------------- MESSAGE D'ERREUR -------------------------------------------------------- 
-->
<?php if (!empty($_SESSION['erreur'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['erreur'];
        unset($_SESSION['erreur']);
        ?>
    </div>
<?php endif; ?>

<!-- 
    -------------------------------------------------------- FORMULAIRE DE CONNEXION-------------------------------------------------------- 
-->
<?= $loginForm ?>

<!-- 
    ------ BOUTON ------
-->
<div class="text-center">
    <a href="/users/register">Pas encore inscrit - S'inscrire</a>
</div>