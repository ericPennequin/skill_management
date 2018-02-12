<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Profil
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Fonction permettant d'afficher un bloc contenant une information sur le profil.
 * @param string $label le libellé de l'information
 * @param string $value la valeur de l'information
 * @param string $icon l'icône FontAwesome correspondant à l'information
 */
function displayProfileInfo($label, $value, $icon)
{
    ?>
    <div class="col-md-6 infos-wrap">
        <div class="infos-col infos-icon">
            <div class="icon-bg">
                <div class="icon-wrap">
                    <i class="fas <?= $icon ?> ic-icons"></i>
                </div>
            </div>
        </div>
        <div class="infos-col infos-contenu">
            <div class="ic-libelle"><?= $label ?></div>
            <?php
            if ($label === "Mail") {
                ?>
                <div class="ic-valeur">
                    <a href="mailto:<?= $value ?>">
                        <?= $value ?>
                    </a>
                </div>
                <?php
            } else if ($label === "Téléphone") {
                ?>
                <div class="ic-valeur">
                    <a href="tel:<?= displayPhoneNumber($value, "indicatif") ?>">
                        <?= displayPhoneNumber($value, "spaces") ?>
                    </a>
                </div>
                <?php
            } else {
                ?>
                <div class="ic-valeur"><?= $value ?></div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Affiche un numéro de téléphone français selon un format donné
 * @param string $number le numéro de téléphone à 10 chiffres
 * @param string $format le format voulu (indicatif\spaces\normal)
 * @return string le numéro de téléphone dans le format souhaité
 */
function displayPhoneNumber($number, $format = "normal")
{
    // On remet le numéro dans un format 0XXXXXXXXXX
    $number = str_replace("+33", "0", $number);
    $number = str_replace(" ", "", $number);

    switch ($format) {
        case "indicatif":
            return "+33" . ltrim($number, '0');
        case "spaces":
            return chunk_split($number, 2, ' ');
        case "normal":
        default:
            return $number;
    }
}