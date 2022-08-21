<h1 class="text-primary text-center my-5">Mon profil</h1>

<h2 class="text-center my-5">Publier une annonce dans :</h2>

<div class="row justify-content-center p-1">
    <?php foreach ($categories as $category) : ?>
        <div class="text-center border border-primary m-1 rounded col-sm-4 col-md-3 col-lg-3">
            <h3><a href="/annonces/ajouter/<?= $category->id ?>" class="fT-Resp"><?= $category->name ?></a></h3>
        </div>
    <?php endforeach; ?>
</div>

<!-- BOUTON VOIR MES ANNONCES-->
<div class="mt-5">
    <a href="/users/annonces" class="btn btn-primary btn-sm btn-block">Voir mes annonces</a>
</div>