<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Profil
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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