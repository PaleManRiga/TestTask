<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'classes/user.php';

$objUser = new User();

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>email</th>
                    <th></th>
                </tr>
            </thead>
            <?php
            $query = "SELECT * FROM crud_users";
            $stmt = $objUser->runQuery($query);
            $stmt->execute();

            ?>
            <tbody>
                <?php
                if ($stmt->rowCount() > 0) {
                    while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)) {

                ?>
                <tr>
                    <td><?php print($rowUser['id']) ?></td>
                    <td>   
                <a href="index.php?edit_id=<?php print($rowUser['id']); ?>">
                    <?php print($rowUser['email']) ?>
                    </a>
                </td>
                    <td><a href="index.php?delete_id=<?php print($rowUser['id']); ?>">
                    <span>X</span>
                    </a>
                </td>
                </tr>
            </tbody>
            <?php } }?>
        </table>
    </div>


</body>

</html>