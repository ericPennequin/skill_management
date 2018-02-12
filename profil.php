<?php
// Variables de test
$profilePic = "http://www.gigtime.co/assets/fallback/default_user_avatar_huge.jpg";
$name = "John Doe";

$pageTitle = "Profil | ${name}";
?>
<?php include "header.php" ?>
    <div id="profil-top">
        <div id="profil-blur"></div>
        <div id="profil-avatar">
            <div id="profil-img"></div>
        </div>
        <div id="profil-name">
            <?= $name ?>
        </div>
    </div>
    <div id="profil-bottom">
        <div id="profil-content">
            <section class="ps profil-section" id="ps-infos" data-ps-parent="infos">
                <h2 class="section-header sh-open">Profil</h2>
                <div class="section-content sc-open" id="sc-infos" data-ps-child="infos">

                </div>
            </section>
            <section class="ps profil-section" id="ps-competences" data-ps-parent="competences">
                <h2 class="section-header">Compétences</h2>
                <div class="section-content" id="sc-competences" data-ps-child="competences">
                    compétence 1 compétence 2
                </div>
            </section>
            <section class="ps profil-section" id="ps-projets" data-ps-parent="projets">
                <h2 class="section-header">Projets</h2>
                <div class="section-content" id="sc-projets" data-ps-child="projets">
                    projet 1, projet 2
                </div>
            </section>
        </div>
    </div>
<?php include "footer.php" ?>