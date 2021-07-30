<?php include('header.html') ?>
<?php include('menu_base.html') ?>

<div class="page-header">
    <h1>Account info : </h1>
</div>
<p>Account of : <br> <?= $compte->getTitulaire()->nom ?> <?= $compte->getTitulaire()->prenom ?> born on <?= $compte->getTitulaire()->convertDate() ?>.</p>
<div>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th scope='col'>Number account</th>
                <th scope='col'>Account balance</th>
                <th scope='col'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?= $compte->getNumero() ?></td>
                <td scope="row"><?= $compte->getSolde() ?></td>
                <td scope="row">
                    <div class="btn-group" role="group">
                        <a href="compte/retrait/<?= $compte->getNumero() ?>" class="btn btn-primary">Withdrawal</a>
                        <a href="compte/depot/<?= $compte->getNumero() ?>" class="btn btn-info">Deposit</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<?php include('footer.html') ?>