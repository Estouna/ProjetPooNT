<h1 class="text-white bg-primary text-center mt-4 mb-5 p-2">Nouvelle sous-catégorie</h1>

<!-- 
    -------------------------------------------------------- MESSAGES-------------------------------------------------------- 
-->
<?php if (!empty($_SESSION['erreur'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['erreur'];
            unset($_SESSION['erreur']); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
<!-- 
    -------------------------------------------------------- FORMULAIRE AJOUT D'UNE CATEGORIE RACINE ET DE SA SOUS-CATEGORIE-------------------------------------------------------- 
-->
<form method="post" action="#" class="my-5">


    <label for="titre-sc">Titre de la sous-catégorie</label>
    <input class="form-control" type="text" name="titre-sc">


    <button class="btn btn-primary my-4" type="submit" name="validateCateg">Ajouter</button>
</form>