<?php
// Variables de test
$profilePic = "http://www.gigtime.co/assets/fallback/default_user_avatar_huge.jpg";
$profilePic = "http://jaimelafrance.tourisme.fr/wp-content/uploads/2015/09/La_Joconde-750x563.jpg";
$tmp_name = "Jo' Conde";
$tmp_phone = "0606060606";
$tmp_mail = "tmp.mail@gmail.com";
$tmp_etab = "CEFIM";
$tmp_city = "Tours (37)";
$tmp_skills = array(
    0 => "HTML",
    1 => "CSS",
    2 => "PHP",
    3 => "qsdf",
    4 => "qsdf",
    5 => "qsdf",
    6 => "qsdf",
    7 => "qsdf",
    8 => "qsdf",
    9 => "qsdf",
    10 => "qsdf",
    11 => "qsdf",
    12 => "qsdf",
    13 => "qsdf",
    14 => "qsdf",
    15 => "qsdf",
    16 => "qsdf",
    17 => "qsdf",
    18 => "qsdf",
    19 => "qsdf",
    20 => "qsdf",
    21 => "qsdf",
    22 => "qsdf"
);
// PROJET 1
$project1_skills = array(
    0 => "HTML",
    1 => "CSS",
    2 => "PHP",
    3 => "qsdf",
    4 => "qsdf",
    5 => "qsdf"
);
$p1 = array(
    "id_project" => 43,
    "id_establishment" => 32,
    "name" => "Mise en place d'un système de gestion de compétences",
    "description" => "Etiam lobortis porttitor arcu, non facilisis dolor imperdiet et. Aenean laoreet luctus ipsum, id consectetur mi ultrices eget. Suspendisse sed metus sed elit vestibulum mollis eu sed risus. Vivamus euismod lectus sit amet libero condimentum, ut luctus eros finibus. Integer finibus urna nec justo lacinia iaculis. Sed in mi tellus. Curabitur sed dui mi.

Mauris convallis tempor nibh, vel pulvinar leo vehicula sed. Donec ut metus quis mi scelerisque aliquet. Praesent pretium est a ipsum porttitor ultrices. Integer maximus neque a purus suscipit vestibulum. Fusce ultrices dolor nibh. Donec accumsan semper lacus, et placerat nulla consectetur hendrerit. Etiam tempor nisl id tellus luctus, vitae aliquam arcu vestibulum. Suspendisse iaculis est vel ante porttitor semper. Duis a placerat tellus, at suscipit metus. Curabitur dictum volutpat magna sed faucibus. Quisque mollis, massa et pretium pharetra, lectus metus mattis ante, sit amet euismod ligula velit et ipsum. Proin aliquet orci sapien, eget fermentum velit blandit at. Donec at felis id lorem ultrices sagittis quis molestie risus. Nam dui neque, consequat sed vestibulum a, malesuada id risus.

Sed eu nisl sed nisl pharetra sollicitudin. Sed id tempus elit. Mauris aliquet gravida justo, et tincidunt mi egestas eget. Nulla malesuada augue non massa pharetra, a molestie massa ullamcorper. Cras vitae quam euismod, ornare erat in, vestibulum massa. Vestibulum ac elit erat. Morbi in imperdiet quam. Etiam vel egestas nisi.

",
    "status" => 1,
    "skills" => $project1_skills
);
// PROJET 2
$project2_skills = array(
    0 => "Rien",
    1 => "Ok",
    2 => "PHP",
    3 => "qsdf",
    4 => "qsdf",
    5 => "qsdf",
    6 => "qsdf",
    7 => "qsdf",
    8 => "qsdf",
    9 => "qsdf",
    10 => "qsdf",
    11 => "qsdf",
    12 => "qsdf",
    13 => "qsdf",
    14 => "qsdf",
    15 => "qsdf"
);
$p2 = array(
    "id_project" => 65,
    "id_establishment" => 12,
    "name" => "Projet YJTh,nyb,u",
    "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi enim diam, iaculis pharetra ex nec, blandit mattis tortor. Pellentesque iaculis posuere dolor, non varius velit congue a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ligula sed erat consectetur iaculis. Sed et congue tortor. Etiam eleifend lacus et elit aliquam malesuada. Donec non vulputate lacus, ut rhoncus odio. Phasellus consectetur iaculis odio, a vulputate neque aliquam rutrum.

Mauris consequat imperdiet interdum. Aliquam dolor arcu, efficitur sed egestas a, imperdiet non dolor. Etiam et tempor sem. Duis vestibulum blandit ligula vel venenatis. Duis ornare scelerisque neque, eleifend accumsan tortor euismod id. Phasellus mollis pretium lectus vel ultricies. Nam aliquet sit amet mi in suscipit. Curabitur ultrices libero pharetra eros tempor, id efficitur mauris blandit. Praesent accumsan bibendum ornare. Donec at ipsum sed diam condimentum rutrum. Aliquam quis accumsan lacus. Nullam eu dolor vel nunc elementum mattis nec laoreet justo. In a dolor nisl.",
    "status" => 1,
    "skills" => $project2_skills
);
// PROJET 3
$project3_skills = array(
    0 => "Rien",
    1 => "Ok",
    2 => "PHP",
    3 => "qsdf",
    4 => "qsdf",
    5 => "qsdf",
    6 => "qsdf",
    7 => "qsdf",
    8 => "qsdf",
    9 => "qsdf",
    10 => "qsdf",
    11 => "qsdf",
    12 => "qsdf",
    13 => "qsdf",
    14 => "qsdf",
    15 => "qsdf"
);
$p3 = array(
    "id_project" => 87,
    "id_establishment" => 34,
    "name" => "Projet YJTh,nyb,u",
    "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi enim diam, iaculis pharetra ex nec, blandit mattis tortor. Pellentesque iaculis posuere dolor, non varius velit congue a.",
    "status" => 1,
    "skills" => $project3_skills
);
// PROJETS
$tmp_projects = array($p1, $p2, $p3);

////////////////////////////////
////////////////////////////////
////////////////////////////////

// Includes
include "../inc/functions.php";
include "../Controller/Person.php";
// Vérification qu'un ID est bien passé en paramètre
if (isset($_GET['id'])) {
    $profilID = $_GET['id'];

    // On appelle les requêtes nécessaires


    $personne = new Person($profilID);
    echo "<pre>";
    $personne->getPersonInfos();
    echo "</pre>";
    exit;

//    if (isset($result) & !empty($result)) {
//
//    } else {
//        echo "ERROR 2 : profil inconnu";
//        // REDIRECTION
//        exit;
//    }
} else {
    echo "ERROR 1";
    // REDIRECTION
    exit;
}


// Variables nécessaires
$url = $_SERVER['REQUEST_URI'];
if (substr($url, -1) == "/")
    $rootUrl = "../..";
else
    $rootUrl = "..";

$pageTitle = "Profil | ${tmp_name}";
?>
<?php include "../inc/header.php"; ?>

    <script>
        FontAwesomeConfig = {searchPseudoElements: true};
    </script>
    <div id="profil-top">
        <div id="profil-blur"></div>
        <div id="profil-avatar">
            <div id="profil-img"></div>
        </div>
        <div id="profil-name">
            <?= $tmp_name ?>
        </div>
    </div>
    <div id="profil-bottom">
        <div id="profil-content">
            <!-- Profil -->
            <section class="ps ps-open profil-section" id="ps-infos" data-ps-parent="infos">
                <h2 class="section-header">Profil
                    <span class="section-toggle st-open">
                        <i class="fas fa-chevron-down sh-icons"></i>
                    </span>
                    <span class="section-toggle st-close">
                        <i class="fas fa-chevron-up sh-icons"></i>
                    </span>
                </h2>
                <div class="section-content" id="sc-infos" data-ps-child="infos" style="display:block;">
                    <!-- content start -->
                    <div class="row">
                        <?php displayProfileInfo("Téléphone", $tmp_phone, "fa-phone") ?>
                        <?php displayProfileInfo("Établissement", $tmp_etab, "fa-building") ?>
                        <?php displayProfileInfo("Mail", $tmp_mail, "fa-envelope") ?>
                        <?php displayProfileInfo("Ville", $tmp_city, "fa-home") ?>
                    </div>
                    <!-- content end -->
                </div>
            </section>
            <!-- Compétences -->
            <section class="ps ps-closed profil-section" id="ps-competences" data-ps-parent="competences"
                     style="visibility:hidden;display:none;">
                <h2 class="section-header">Compétences <span class="section-count"><?= count($tmp_skills) ?></span>
                    <span class="section-toggle st-open">
                        <i class="fas fa-chevron-down sh-icons"></i>
                    </span>
                    <span class="section-toggle st-close">
                        <i class="fas fa-chevron-up sh-icons"></i>
                    </span>
                </h2>
                <div class="section-content" id="sc-competences" data-ps-child="competences" style="display:none;">
                    <!-- content start -->
                    <?php displaySkills($tmp_skills) ?>
                    <!-- content end -->
                </div>
            </section>
            <!-- Projets -->
            <section class="ps ps-open profil-section" id="ps-projets" data-ps-parent="projets">
                <h2 class="section-header">Projets <span class="section-count"><?= count($tmp_projects) ?></span>
                    <span class="section-toggle st-open">
                        <i class="fas fa-chevron-down sh-icons"></i>
                    </span>
                    <span class="section-toggle st-close">
                        <i class="fas fa-chevron-up sh-icons"></i>
                    </span>
                </h2>
                <div class="section-content" id="sc-projets" data-ps-child="projets">
                    <!-- content start -->
                    <?php displayProjects($tmp_projects) ?>
                    <!-- content end -->
                </div>
            </section>
        </div>
    </div>
<?php include "./inc/footer.php" ?>