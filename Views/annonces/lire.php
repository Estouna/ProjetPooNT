<!-- 
    -------------------------------------------------------- AFFICHAGE D'UNE ANNONCE-------------------------------------------------------- 
-->
<article class="text-center mt-5">
    <h2 class="text-primary"><?= $annonce->titre ?></h2>
    <p><?= $annonce->created_at ?></p>
    <p><?= $annonce->description ?></p>
</article>