<?php include('header.html') ?>
<?php include('menu_base.html') ?>

<div class="page-header">
    <h1><?= $title ?></h1>
</div>
<div>
    <form action="personne/<?= $action ?>" method="POST">
        <div class="form-group">
            <label for="prenom">Firstname : </label>
            <input class="form-control mb-2" type="text" id="prenom" name="prenom" placeholder="Prenom" value="<?= $person->prenom ?>">
        </div>
        <div class="form-group">
            <label for="nom">Lastname : </label>
            <input class="form-control mb-2" type="text" id="nom" name="nom" placeholder="Nom" value="<?= $person->nom ?>">
        </div>
        <div class="form-group">
            <div class="dates">
                <label for="usr1">Birthdate : </label>
                <input type="text" class="form-control" name="datenaiss" id="usr1" autocomplete="off" placeholder="yyyy-mm-dd" value="<?= $person->convertDate() ?>" />
            </div>
        </div>
        <div>
            <hr>
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>

<?php include('footer.html') ?>