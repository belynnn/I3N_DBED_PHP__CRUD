<?php include('header.html') ?>
<?php include('menu_base.html') ?>

<div class="page-header">
    <h1>List of persons : </h1>
</div>
<div>
    <table class="table table-striped shadow-lg p-3 mb-5 bg-body rounded">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $person) : ?>
                <tr>
                    <td scope="row"><?= $person->id ?></td>
                    <td scope="row"><?= $person->nom ?></td>
                    <td scope="row"><?= $person->prenom ?></td>
                    <td scope="row"><?= $person->convertDate() ?></td>
                    <td scope="row">
                        <div class="btn-group" role="group">
                            <a href="personne/edit/<?= $person->id ?>" class="btn btn-primary">Edit</a>
                            <a href="personne/info/<?= $person->id ?>" class="btn btn-info">Info</a>
                            <a href="personne/delete/<?= $person->id ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr />
    <a href="personne/create" class="btn btn-primary">Create a person</a>
</div>

<?php include('footer.html') ?>