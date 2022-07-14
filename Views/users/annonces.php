<h1 class="text-primary text-center my-5">Mes annonces</h1>

<!-- 
    -------------------------------------------------------- Annonces de l'utilisateur -------------------------------------------------------- 
-->
<table class="table table-striped">
    <thead>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($annonces as $annonce) : ?>
            <tr>
                <td><?= $annonce->titre ?></td>
                <td><?= $annonce->description ?></td>
                <td>
                    <a href="/annonces/modifier/<?= $annonce->id ?>" class="btn btn-warning">Modifier</a>
                    <a href="/users/supprimeUserAnnonce/<?= $annonce->id ?>" class="btn btn-danger" onclick='return confirm(" Cette action est irréversible, êtes-vous sûr ? ")'>Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>