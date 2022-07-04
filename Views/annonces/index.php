<!-- 
    -------------------------------------------------------- LISTE DES ANNONCES -------------------------------------------------------- 
-->
<h1 class="text-primary text-center my-5">Liste des annonces</h1>

<?php foreach ($annonces as $annonce) : ?>
    <article class="border border-primary my-3 p-2 rounded">
        <h2><a href="/annonces/lire/<?= $annonce->id ?>"><?= $annonce->titre ?></a></h2>
        <p><?= $annonce->description ?></p>
    </article>
<?php endforeach; ?>