<?php include('header.html') ?>
<?php include('menu_base.html') ?>

<div class="page-header">
    <h1>Account of : <?= $person->nom ?> <?= $person->prenom ?> </h1>
</div>
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">Number account</td>
                <td scope="col">Account balance</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $compte) : ?>
                <tr>
                    <td scope="row"><?= $compte->getNumero(); ?></td>
                    <td scope="row"><?= $compte->getSolde(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <a href="compte/create/<?= $person->id ?>" class="btn btn-primary">Create an account</a>
</div>

<?php include('footer.html') ?>