<h1 class="text-primary text-center mb-5">Inscription</h1>

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
    -------------------------------------------------------- FORMULAIRE D'INSCRIPTION -------------------------------------------------------- 
-->
<?= $registerForm ?>

<div class="text-center">
    <a href="/users/login">Déjà inscrit - Me connecter</a>
</div>