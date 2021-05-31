<?php
$active = 5;
require ("head.php");
mustBeConnected();
mustBeAdmin();
?>

<div class="card p-3 bg-light">
    <table id="users" class="table table-striped table-bordered table-responsive">
        <thead>
        <tr>
            <th>id</th>
            <th>Création</th>
            <th>Demandeur</th>
            <th>Téléphone</th>
            <th>Tag</th>
            <th>Photo(s)</th>
            <th>Titre</th>
            <th>Description</th>
            <th>CP</th>
            <th>Ville</th>
            <th>État</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            $pdo = connectDB();
            $query = $pdo->query('SELECT * FROM requests;');
            $result = $query->fetchAll();
            foreach($result as $request){
            ?>

            <?php
            $pdo = connectDB();
            $query = $pdo->query('SELECT * FROM users WHERE id='.$request["user"]);
            $result = $query->fetchAll();
            foreach($result as $user){
            ?>

            <td><?php echo $request["id"] ?></td>
            <td><?php echo $request["publication_date"] ?></td>
            <td><?php echo $user["lastname"] ?> <?php echo $user["firstname"]?></td>
            <td><?php echo $user["phone"] ?></td>
            <td><?php echo $request["tag"] ?></td>
            <td><a href="<?php echo $request["image"] ?>"><img class="tiny-avatar" src="<?php echo $request["image"] ?>" alt="photo"></a></td>
            <td><?php echo $request["title"] ?></td>
            <td><?php echo $request["description"] ?></td>
            <td><?php echo $user["zipcode"] ?></td>
            <td><?php echo $request["city"] ?></td>
            <td><?php echo $request["rank"] ?></td>
            <td>
                <div class="text-center">
                    <a class="link-debian" href="admFunctions/delAskAdm.php?id=<?php echo $request["id"]; ?>">
                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
            </td>

        </tr>
        <?php }} ?>

        </tbody>
    </table>
