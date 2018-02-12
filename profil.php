<?php
// Variables de test
$profilePic = "http://www.gigtime.co/assets/fallback/default_user_avatar_huge.jpg";
$tmp_name = "John Doe";
$tmp_phone = "0606060606";
$tmp_mail = "tmp.mail@gmail.com";
$tmp_etab = "CEFIM";
$tmp_city = "Tours (37)";

$rootURL = "";
$pageTitle = "Profil | ${tmp_name}";

// Includes
include "./inc/functions.php";

?>
<?php include "./inc/header.php" ?>
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
            <section class="ps profil-section" id="ps-infos" data-ps-parent="infos">
                <h2 class="section-header sh-open">Profil</h2>
                <div class="section-content sc-open" id="sc-infos" data-ps-child="infos">
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
            <section class="ps profil-section" id="ps-competences" data-ps-parent="competences">
                <h2 class="section-header">Compétences</h2>
                <div class="section-content" id="sc-competences" data-ps-child="competences">
                    <!-- content start -->
                    compétence 1 compétence 2
                    <!-- content end -->
                </div>
            </section>
            <!-- Projets -->
            <section class="ps profil-section" id="ps-projets" data-ps-parent="projets">
                <h2 class="section-header">Projets</h2>
                <div class="section-content" id="sc-projets" data-ps-child="projets">
                    <!-- content start -->
                    projet 1, projet 2
                    <!-- content end -->
                </div>
            </section>
        </div>
    </div>
<?php include "./inc/footer.php" ?>