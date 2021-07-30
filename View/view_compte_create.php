<?php include('header.html') ?>
<?php include('menu_base.html') ?>

<div class="page-header">
    <h1><? $title ?></h1>
</div>
<div>
    <form action="compte/<?= $action ?>" method="POST">
        <div class="form-group">
            <label for="numero">Numero : </label>
            <input class="form-control mb-2" type="text" id="numero" placeholder="000001" value="<?= $numero ?>" name="numero">
        </div>
        <?php if ($titulaire != null) : ?>
            <div class="form-group">
                <label for="titulaire">Owner : </label>
                <input class="form-control mb-2" type="text" id="titulaire" name="titulaire" placeholder="Titulaire" value="<?= $titulaire ?>" disabled>
            </div>
        <?php elseif ($persons != null) : ?>
            <div class="from-group">
                <label for="titulaire_id">titulaire</label>
                <select class="form-select" name="titulaire_id">
                    <?php foreach ($persons as $person) : ?>
                        <option value="<?= $person->id ?>"><?= $person ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div>
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>

<?php include('footer.html') ?>