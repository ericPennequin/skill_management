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
                    <a href="mailto:<?= $value ?>" class="tel-mail">
                        <?= $value ?>
                    </a>
                </div>
                <?php
            } else if ($label === "Téléphone") {
                ?>
                <div class="ic-valeur">
                    <a href="tel:<?= displayPhoneNumber($value, "indicatif") ?>" class="tel-mail">
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

/**
 * Affiche la liste des compétences passées dans un tableau
 * @param array $skills la liste des compétences
 */
function displaySkills(array $skills)
{
    if (count($skills) > 0) {
        foreach ($skills as $id => $skill) {
            echo "<a class=\"ct competence-tag\" data-competence-title=\"${skill}\" id=\"ct-${id}\" href=\"#${skill}-${id}\">${skill}</a>";
        }
    } else {
        echo "Il n'y a aucune compétence à afficher.";
    }
}

/**
 * Affiche la liste des pièces jointes passées dans un tableau
 * @param array $attachments la liste des pièces jointes
 */
function displayAttachments(array $attachments)
{

}

/**
 * Affiche la description d'un projet
 * @param string $description la description du projet
 * @param int $id l'identifiant du projet
 */
function displayDescription($description, $id)
{
    if (strlen($description) > 340) {
        $maxChars = 350;
        $strStart = substr($description, 0, $maxChars);
        $strEnd = substr($description, $maxChars);
        ?>
        <span class="description-start description-hidden" data-description-start="<?= $id ?>"><?= $strStart ?></span>
        <a class="show-more" data-description-id="<?= $id ?>" href="#pp-<?= $id ?>">En savoir plus</a>
        <span class="description-end" data-description-end="<?= $id ?>"><?= $strEnd ?></span>
    <?php } else {
        echo $description;
    }

}

/**
 * Affiche la liste des projets passées dans un tableau
 * @param array $projects la liste des projets
 */
function displayProjects(array $projects)
{
    if (count($projects) > 0) {
        foreach ($projects as $id => $project) { ?>
            <div class="profil-projet"
                 data-projet-title="<?= $project["name"] ?>"
                 id="pp-<?= $project["id_project"] ?>">
                <h3 class="projet-header"><?= $project["name"] ?></h3>
                <div class="projet-location">LJK<?= $project["id_establishment"] ?>JYGHB</div>
                <p class="projet-description">
                    <? displayDescription($project["description"], $project["id_project"]) ?>
                </p>
                <div class="projet-competences">
                    <?php displaySkills($project["skills"]) ?>
                </div>
                <div class="projet-files">
                    <a class="pf pf-word" href="" download="download">test_file.docx</a>
                    <a class="pf pf-pdf" href="" download="download">test_file.pdf</a>
                    <a class="pf pf-img" href="" download="download">test_file.png</a>
                    <a class="pf pf-default" href="" download="download">test_file.bin</a>
                </div>
                <?php if (count($project["attachments"]) > 0) {
                    displayAttachments($project["attachments"]);
                } ?>
            </div>
            <?php
        }
    } else {
        echo "Il n'y a aucun projet à afficher.";
    }
}