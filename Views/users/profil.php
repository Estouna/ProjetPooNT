<h1 class="text-primary text-center my-5">Mon profil</h1>
<h2 class="text-center my-5">Publier une annonce</h2>
<div class="row justify-content-center p-1">
    <?php foreach ($categories as $category) : ?>
        <div class="text-center border border-primary my-2 rounded col-sm-5 col-md-4 col-lg-4">
            <h3><a href="/annonces/ajouter/<?= $category->id ?>" class="fT-Resp"><?= $category->name ?></a></h3>
        </div>
    <?php endforeach; ?>
</div>

<!-- BOUTON VOIR MES ANNONCES-->
<div class="mt-5">
    <a href="/users/annonces" class="btn btn-primary btn-sm btn-block">Voir mes annonces</a>
</div>