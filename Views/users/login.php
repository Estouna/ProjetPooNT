<h1 class="text-primary text-center mb-5">Connexion</h1>

<!-- 
    -------------------------------------------------------- MESSAGES -------------------------------------------------------- 
-->
<?php if (!empty($_SESSION['erreur'])) : ?>
    <div class="alert alert-danger text-center" role="alert">
        <?php
        echo $_SESSION['erreur'];
        unset($_SESSION['erreur']);
        ?>
    </div>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])) : ?>
    <div class="alert alert-success text-center" role="alert">
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
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