<?php
// Variables de test
$profilePic = "http://www.gigtime.co/assets/fallback/default_user_avatar_huge.jpg";
$profilePic = "https://cloud.netlifyusercontent.com/assets/344dbf88-fdf9-42bb-adb4-46f01eedd629/68dd54ca-60cf-4ef7-898b-26d7cbe48ec7/10-dithering-opt.jpg";
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
        profil<br/>
        compétences<br/>
        projets
    </div>
<?php include "footer.php" ?>