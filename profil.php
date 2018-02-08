<?php
$profil_pic = "https://pbs.twimg.com/profile_images/874276197357596672/kUuht00m_400x400.jpg";
$name = "Tonald Drump";
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Profil | <?= $name ?>
    </title>
    <style id="style-profil"> /* généré par php */
        #profil-top {
            background: url('<?= $profil_pic ?>') repeat;
            background-size: 1px;
        }
        #blur {
            background: url('<?= $profil_pic ?>');
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