<?php
// Includes
include "../inc/functions.php";
include "../Controller/Person.php";

$pageTitle = "test datatable";

// Variables nécessaires
$url = $_SERVER['REQUEST_URI'];
if (substr($url, -1) == "/")
    $rootUrl = "../..";
else
    $rootUrl = "..";

include "../inc/header.php";

$list = array(1, 2, 3);
?>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <table id="myTable">
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>NOM</th>
        </tr>
        <?php
        foreach ($list as $id) {
            // init
            $personne = new Person($id);
            $personne->getPersonInfos();
            ?>
            <tr>
                <td><?= $id; ?></td>
                <td>
                    <a href="profil.php?id=<?= $id; ?>">
                        <?= $personne->getFullName(); ?>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

<?php
function displayTestDT($personne)
{

}