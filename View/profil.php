<?php
// Includes
include "../inc/functions.php";
include "../Controller/Person.php";

// Vérification qu'un ID est bien passé en paramètre
if (isset($_GET['id'])) {
    $profilID = $_GET['id'];
    $personne = new Person($profilID);
    $personne->getPersonInfos();
} else {
    echo "ERROR 1 : ID non reconnu.";
    // REDIRECTION
    exit;
}

// Variables nécessaires
$url = $_SERVER['REQUEST_URI'];
if (substr($url, -1) == "/")
    $rootUrl = "../..";
else
    $rootUrl = "..";


$profilFullName = $personne->getFullName();
$profilePic = $personne->getProfilPic();
$profilePhoneNumber = $personne->getPhoneNumber();
$profileEmail = $personne->getEmail();
$profileEstablishmentName = $personne->getEstablishmentName();
$profileEstablishmentCity = $personne->getEstablishmentCity();

$pageTitle = "Profil | $profilFullName";
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
            <?= $profilFullName ?>
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
                        <? $personne->displayProfileInfos() ?>
                    </div>
                    <!-- content end -->
                </div>
            </section>
            <!-- Projets -->
            <section class="ps ps-open profil-section" id="ps-projets" data-ps-parent="projets">
                <h2 class="section-header">Projets <span class="section-count"><?= $personne->getProjectsCount() ?></span>
                    <span class="section-toggle st-open">
                        <i class="fas fa-chevron-down sh-icons"></i>
                    </span>
                    <span class="section-toggle st-close">
                        <i class="fas fa-chevron-up sh-icons"></i>
                    </span>
                </h2>
                <div class="section-content" id="sc-projets" data-ps-child="projets">
                    <!-- content start -->
                    <?php $personne->displayProfilProjects() ?>
                    <!-- content end -->
                </div>
            </section>
        </div>
    </div>
<?php include "./inc/footer.php" ?>