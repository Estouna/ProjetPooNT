<!-- 
    -------------------------------------------------------- PLAN DE L'ARBRE DES CATEGORIES JUSQU'AU LV 5 -------------------------------------------------------- 
-->
<h1 class="text-primary text-center my-5 border-bottom border-primary">Plan de l'arbre des catégories jusqu'au niveau 5</h1>

<div class="row justify-content-center">
    <!-- $categorieRacine = catégories avec level 0, $sub_categoriesLv1 = level 1, etc -->
    <?php foreach ($categories_racine as $c) : ?>
        <div class="col-lg-3 col-md-4 col-sm-5 text-center m-2 py-4">
            <div class="bg-primary text-white p-1">
                <h2><?= $c->name ?></h2>
                <p class="text-warning">Bg = <?= $c->lft ?> et Bd = <?= $c->rght ?></p>
            </div>
            <?php foreach ($sub_categoriesLv1 as $sc1) : ?>
                <?php if ($c->id === $sc1->parent_id) : ?>
                    <div class="bg-success text-white p-1 mt-3 border border-dark">
                        <h2><?= $sc1->name ?></h2>
                        <p class="text-warning">Bg = <?= $sc1->lft ?> et Bd = <?= $sc1->rght ?></p>
                    </div>
                    <?php foreach ($sub_categoriesLv2 as $sc2) : ?>
                        <?php if ($sc1->id === $sc2->parent_id) : ?>
                            <div class="bg-info text-white p-1 mt-2">
                                <h2><?= $sc2->name ?></h2>
                                <p class="text-warning">Bg = <?= $sc2->lft ?> et Bd = <?= $sc2->rght ?></p>
                            </div>
                            <?php foreach ($sub_categoriesLv3 as $sc3) : ?>
                                <?php if ($sc2->id === $sc3->parent_id) : ?>
                                    <div class="bg-secondary text-white p-1">
                                        <h2><?= $sc3->name ?></h2>
                                        <p class="text-warning">Bg = <?= $sc3->lft ?> et Bd = <?= $sc3->rght ?></p>
                                    </div>
                                    <?php foreach ($sub_categoriesLv4 as $sc4) : ?>
                                        <?php if ($sc3->id === $sc4->parent_id) : ?>
                                            <div class="bg-dark text-white p-1">
                                                <h2><?= $sc4->name ?></h2>
                                                <p class="text-warning">Bg = <?= $sc4->lft ?> et Bd = <?= $sc4->rght ?></p>
                                            </div>
                                            <?php foreach ($sub_categoriesLv5 as $sc5) : ?>
                                                <?php if ($sc4->id === $sc5->parent_id) : ?>
                                                    <div class="bg-danger text-white p-1">
                                                        <h2><?= $sc5->name ?></h2>
                                                        <p class="text-warning">Bg = <?= $sc5->lft ?> et Bd = <?= $sc5->rght ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

</div>