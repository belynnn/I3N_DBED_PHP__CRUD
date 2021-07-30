<?php include('header.html') ?>
<?php include('menu_base.html') ?>

<div class="page-header">
    <h1>List of accounts : </h1>
</div>
<div>
    <table class="table table-stripped shadow-lg p-3 mb-5 bg-body rounded">
        <thead>
            <tr>
                <th scope="col">Numero</th>
                <th scope="col">Owner</th>
                <th scope="col">Sold</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $compte) : ?>
                <tr>
                    <td scope="row"><?= $compte->getNumero() ?></td>
                    <td scope="row"><?= $compte->getTitulaire() ?></td> <!-- fait appel au _tostring de Personne -->
                    <td scope="row"><?= $compte->getSolde() ?></td>
                    <td scope="row">
                        <div class="btn-group" role="group">
                            <a href="compte/edit/<?= $compte->getNumero() ?>" class="btn btn-primary">Edit</a>
                            <a href="compte/info/<?= $compte->getNumero() ?>" class="btn btn-info">Info</a>
                            <a href="compte/delete/<?= $compte->getNumero() ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <a href="compte/create" class="btn btn-success ">Create an account</a>
</div>

<?php include('footer.html') ?>