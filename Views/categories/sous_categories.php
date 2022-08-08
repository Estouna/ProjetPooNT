<!-- 
    -------------------------------------------------------- AFFICHAGE DES SOUS-CATEGORIES -------------------------------------------------------- 
-->
<div class="text-center my-5">
    <h1 class="text-primary">Sous-catégories</h1>
</div>

<?php foreach ($sub_categories as $sc) : ?>
    <div class="text-center border border-primary my-4 p-2 rounded">
    <?php if ($sc->rght - $sc->lft !== 1) { ?>
        <h2><a href="/categories/sous_categories/<?= $sc->id ?>"><?= $sc->name ?></a></h2>
        <?php } else { ?>
        <h2><a href="/categories/annonces/<?= $sc->id ?>"><?= $sc->name ?></a></h2>
        <?php } ?>
    </div>
<?php endforeach; ?>