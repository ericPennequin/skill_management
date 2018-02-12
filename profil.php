<?php
$profil_pic = "http://www.gigtime.co/assets/fallback/default_user_avatar_huge.jpg";
$name = "John Doe";
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Profil | <?= $name ?>
    </title>
    <link rel="stylesheet" media="screen" type="text/css" title="profil" href="css/profil.css"/>
    <style id="style-profil">
        #profil-top {
            background: url('<?= $profil_pic ?>') repeat;
            background-size: 1px;
        }

        #profil-blur {
            background: url('<?= $profil_pic ?>') no-repeat 50%;
            background-size: 100%;
        }
    </style>
</head>
<body>
<div id="profil-top">
    <div id="profil-blur"></div>
    <div id="profil-avatar">
        <img src="<?= $profil_pic ?>"/>
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
</body>
</html>