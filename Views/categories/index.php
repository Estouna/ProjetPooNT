<!-- 
    -------------------------------------------------------- CATEGORIES -------------------------------------------------------- 
-->
<h1 class="text-primary text-center my-5">Catégories</h1>

<div class="row justify-content-center">
    <?php foreach ($categories as $category) : ?>

        <div class="col-lg-3 col-md-4 col-sm-5 text-center m-2 py-4">
            <h2><a href="/categories/sous_categories/<?= $category->id ?>"><?= $category->name ?></a></h2>
            <?php foreach ($subCat as $sc) : ?>

                <?php if (isset($category->id) && $sc->parent_id === $category->id) : ?>

                    <?php if ($sc->rght - $sc->lft !== 1) { ?>
                        <p><a href="/categories/sous_categories/<?= $sc->id ?>"><?= $sc->name ?></a></p>
                    <?php } else { ?>
                        <p><a class="text-dark" href="/categories/annonces/<?= $sc->id ?>"><?= $sc->name ?></a></p>
                    <?php } ?>
                    
                <?php endif; ?>

            <?php endforeach; ?>
        </div>

    <?php endforeach; ?>
</div>