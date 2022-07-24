<!-- 
    -------------------------------------------------------- CATEGORIES -------------------------------------------------------- 
-->
<h1 class="text-primary text-center my-5">Catégories</h1>

<?php foreach ($categories as $category) : ?>
    <div class="border border-primary my-4 p-2 rounded">
        <h2><a href="/categories/sous-categories/<?= $category->id ?>"><?= $category->name ?></a></h2>
    </div>
<?php endforeach; ?>
<?php var_dump($categories); ?>