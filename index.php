<?php
$rootUrl = ".";
// Includes
include "inc/functions.php";
include "Controller/Person.php";

// Variables nécessaires
$rootUrl = ".";

$ids = array(1, 2, 3);
foreach ($ids as $id) {
    $person = new Person($id);
    $person->getPersonInfos();
    $persons[] = $person;
}

$skills = ["Java", "JavaScript", "PHP", "HTML", "CSS", "Symfony", "C", "C++", "SQL", "Kahoot"];
$establishments = ["CEFIM", "Lycée Lamotte Beuvron", "PolyTech Tours"];
$mostSearchs = ["Java", "PHP", "JS"];


$pageTitle = "Accueil";
?>
<?php include "./inc/header.php"; ?>
    <link rel="stylesheet" href="dataTables/datatables.min.css">
    <link rel="stylesheet" href="searchPane/dataTables.searchPane.min.css">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="img-fluid" src="img/SkillZ.png" alt="logo skillz"
                     style="margin-top: 1rem; margin-bottom: 3rem">
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-9 offset-2">
                <h5>Les recherches les plus fréquentes...</h5>
                <div class="btn-block">
                    <?php foreach ($mostSearchs as $mostSearch) : ?>
                        <button type="button" class="btn btn-light"
                                style="margin-right: 2rem"><?= $mostSearch ?></button>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <br>

    <div class="container">
        <div class="row">
            <div class="col-9 offset-2">
                <h5>Les derniers profils ajoutés...</h5>

            </div>
            <div class="col-2" id="searchPanes">
            </div>
            <div class="col-10">
                <table class="table table-striped table-bordered table-hover display" id="tableLastAdded" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Etablissement</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /* @var $p Person.php */
                    foreach ($persons as $p) {
                        echo $p->displaySearchTablePerson();
                    } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            var dataTable = $('#tableLastAdded');

            dataTable.DataTable({
                searchPane: {
                    container: '#searchPanes',
                    threshold: 0,
                    columns: [
                        1, 2
                    ]
                },
                "order": [[1, 'asc']],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"
                },
                columnDefs: [
                    {"orderable": false, "targets": 0}
                ]

            });

            dataTable.on('search.dt', function () {
                var value = $('.dataTables_filter input').val();
                if (value.length >= 3)
                    console.log(value); // <-- the value
            });

        });
    </script>
    <script src="dataTables/datatables.min.js" type="text/javascript"></script>
    <script src="searchPane/dataTables.searchPane.min.js" type="text/javascript"></script>

<?php
include 'inc/footer.php';
?>