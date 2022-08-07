<!-- 
    -------------------------------------------------------- AFFICHAGE D'UNE ANNONCE -------------------------------------------------------- 
-->
<article class="text-center mt-5">
    <h2 class="border border-primary text-primary"><?= $annonce->titre ?></h2>
    <p><?= $annonce->created_at ?></p>
    <p class="text-center mt-5"><?= $annonce->description ?></p>
</article>
