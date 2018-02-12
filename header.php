<?php
$currentPageName = basename($_SERVER['PHP_SELF']);

if (!isset($pageTitle) || empty($pageTitle))
    $pageTitle = $currentPageName;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $pageTitle ?></title>
    <link rel="icon" type="image/png" href="favicon.png"/>
    <!--[if IE]>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/><![endif]-->
    <script src="./lib/jquery-3.2.1/jquery-3.2.1.js"></script>
    <script defer src="./lib/fontawesome-free-5.0.6/js/fontawesome-all.js"></script>
    <script src="./lib/bootstrap-4.0.0-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./lib/bootstrap-4.0.0-dist/css/bootstrap.css">

    <?php // PAGE PROFIL
    if ($currentPageName === "profil.php") {
        ?>
        <link rel="stylesheet" media="screen" type="text/css" title="profil" href="css/profil.css"/>
        <style id="style-profil">
            #profil-top {
                background: url('<?= $profilePic ?>') repeat;
                background-size: 1px;
            }

            #profil-avatar #profil-img {
                background: url('<?= $profilePic ?>') no-repeat center;
                background-size: cover;
            }

            #profil-blur {
                background: url('<?= $profilePic ?>') no-repeat 50%;
                background-size: 100%;
            }
        </style>
        <?php
    }
    ?>
</head>
<body>