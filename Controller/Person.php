<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 12:20
 */

include "Establishment.php";
include "Project.php";
include_once "../Model/Querys.php";

class Person
{
    public $id;

    // attributs
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $cellNumber;
    protected $profilPic;
    protected $status;

    // Etablissement(id, name, city)
    protected $establishment;

    // Project
    protected $projects; // liste de Projects

    /**
     * Person constructor.
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getPersonInfos()
    {
        $result = [];
        $result = getQuery("getProfil", array("id_person", $this->id));

        if (!empty($result['userData'])) {
            $this->fillAttributs($result["userData"]);
            return true;
        } else {
            return false;
        }
    }

    protected function fillAttributs(array $array)
    {
        $this->firstName = $array["firstname"];
        $this->lastName = $array["lastname"];
        $this->email = $array["email"];
        $this->cellNumber = $array["cell_number"];
        $this->profilPic = $array["picture"];
        $this->status = $array["status"];
        $this->establishment = Establishment::withID($array["id_establishment"]);
        $this->loadProjectsList();
    }

    protected function loadProjectsList()
    {
        $this->projects = [];
        $result = getQuery("getProjectsList", array("id_establishment", $this->establishment->id));
        foreach ($result as $projectID) {
            $this->projects[$projectID] = Project::withID($projectID);
        }
        unset($result);
    }


    // Fonctions

    public function getFullName()
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function getProfilPic()
    {
        if (isset($this->profilPic) && !empty($this->profilPic))
            return $this->profilPic;
        else
            return "http://jaimelafrance.tourisme.fr/wp-content/uploads/2015/09/La_Joconde-750x563.jpg";
    }

    public function getPhoneNumber()
    {
        return $this->cellNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEstablishmentName()
    {
        return $this->establishment->getName();
    }

    public function getEstablishmentCity()
    {
        return $this->establishment->getCity();
    }

    public function getProjectsList()
    {
        return $this->projects;
    }

    public function getProjectsCount()
    {
        return count($this->getProjectsList());
    }

    // Fonctions d'affichage

    /**
     * Fonction permettant d'afficher un bloc contenant une information sur le profil.
     * @param string $label le libellé de l'information
     * @param string $value la valeur de l'information
     * @param string $icon l'icône FontAwesome correspondant à l'information
     */
    protected function displayProfileInfo($label, $value, $icon)
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
     * Fonction permettant d'afficher les informations sur le profil.
     */
    public function displayProfileInfos()
    {
        $this->displayProfileInfo("Téléphone", $this->getPhoneNumber(), "fa-phone");
        $this->displayProfileInfo("Établissement", $this->getEstablishmentName(), "fa-building");
        $this->displayProfileInfo("Mail", $this->getEmail(), "fa-envelope");
        $this->displayProfileInfo("Ville", $this->getEstablishmentCity(), "fa-home");
    }

    public function displayProfilProjects()
    {
        if ($this->getProjectsCount() > 0) {
            /* @var $p Project.php */
            foreach ($this->projects as $p) { ?>
                <div class="profil-projet"
                     data-projet-title="<?= $p->getName() ?>"
                     id="pp-<?= $p->getID() ?>">
                    <h3 class="projet-header"><?= $p->getName() ?></h3>
                    <!--div class="projet-location">{{ETABLISSEMENT}}</div-->
                    <p class="projet-description">
                        <?php displayDescription($p->getDescription(), $p->getID()) ?>
                    </p>
                    <div class="projet-competences">
                        <?php $p->displaySkillsList() ?>
                    </div>
                    <div class="projet-files">
                        <?php $p->displayAttachmentsList() ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Il n'y a aucun projet à afficher.";
        }
    }


    /**
     * Affiche la liste des projets passées dans un tableau
     * @param array $projects la liste des projets
     *//*
    function displayProjects(array $projects)
    {
        if (count($this->getProjectsCount()) > 0) {
            foreach ($projects as $id => $project) { ?>
                <div class="profil-projet"
                     data-projet-title="<?= $project["name"] ?>"
                     id="pp-<?= $project["id_project"] ?>">
                    <h3 class="projet-header"><?= $project["name"] ?></h3>
                    <div class="projet-location">{{ETABLISSEMENT <?= $project["id_establishment"] ?>}}</div>
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
    }*/

}