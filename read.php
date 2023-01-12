<?php
    require('config.php');

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $dbUser, $dbPassword);
        if ($pdo) {
        } else {
            echo "Interne server-error. Probeer het later nog eens";
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $sql = "SELECT Id
                  ,Merk
                  ,Model
                  ,Topsnelheid
                  ,Prijs
            FROM DureAtuo
            ORDER BY Prijs DESC";

    $statement = $pdo->prepare($sql);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_OBJ);

    $rows = "";
    foreach ($result as $info) {
        $rows .= "<tr>
                    <td>$info->Merk</td>
                    <td>$info->Model</td>
                    <td>$info->Topsnelheid</td>
                    <td>$info->Prijs</td>
                    <td>
                        <a href='delete.php?id={$info->Id}'>
                            <img src='b_drop.png' alt='kruis'>
                        </a>
                    </td>
                  </tr>";
    }
?>

<h3>De vijf duurste auto's ter wereld</h3>
<table border="1">
    <thead>
        <th>Merk</th>
        <th>Model</th>
        <th>Topsnelheid</th>
        <th>Prijs</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?= $rows; ?>   
    </tbody>
</table>