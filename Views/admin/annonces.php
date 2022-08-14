<div class="table-responsive table-sm mt-5">
<table class="table table-dark table-striped fT-Resp">
    <thead>
        <th>ID</th>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Actif</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($annonces as $annonce) : ?>
            <tr>
                <td><?= $annonce->id ?></td>
                <td><?= $annonce->pseudo_author ?></td>
                <td><?= $annonce->titre ?></td>
                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch<?= $annonce->id ?>" <?= $annonce->actif ? 'checked' : '' ?> data-id="<?= $annonce->id ?>">
                        <label class="custom-control-label" for="customSwitch<?= $annonce->id ?>"></label>
                    </div>
                </td>
                <td class="fT-Resp">
                    <a href="/annonces/modifier/<?= $annonce->id ?>" class="btn btn-warning fT-Resp col-sm-5">Modifier</a>
                    <a href="/admin/supprimeAnnonce/<?= $annonce->id ?>" class="btn btn-danger fT-Resp col-sm-6" onclick='return confirm(" Cette action est irréversible, êtes-vous sûr ? ")'>Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>