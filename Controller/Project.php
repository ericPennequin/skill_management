<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 14:16
 */

require "Skill.php";
require "Attachment.php";

class Project
{
    public $id;
    public $idEtablishment;

    protected $name;
    protected $description;
    protected $status;

    protected $skills;

    protected $data;

    /**
     * Project constructor.
     */
    public function __construct()
    {
    }

    public static function withID($id)
    {
        $instance = new self();
        $instance->id = $id;
        $instance->loadByID();
        return $instance;
    }

    protected function loadByID()
    {
        $result = getQuery("getProject", array("id_project", $this->id));
        $this->fill($result);
    }

    protected function fill(array $array)
    {
        $this->idEtablishment = $array['id_establishment'];
        $this->name = $array['name'];
        $this->description = $array['description'];
        $this->status = $array['status'];
        $this->loadSkillsList();
        $this->loadAttachmentsList();
    }

    protected function loadSkillsList()
    {
        $this->skills = [];
        $result = getQuery("getSkillsList", array("id_project", $this->id));
        foreach ($result as $skillID) {
            $this->skills[$skillID] = Skill::withID($skillID);
        }
        unset($result);
    }

    protected function loadAttachmentsList()
    {
        $this->data = [];
        $result = getQuery("getAttachmentsList", array("id_project", $this->id));
        foreach ($result as $attachmentID) {
            $this->data[$attachmentID] = Attachment::withID($attachmentID);
        }
        unset($result);
    }

    //

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSkillsList()
    {
        return $this->skills;
    }

    public function getAttachmentsList()
    {
        return $this->data;
    }

    // Display


    /**
     * Affiche la liste des compétences passées dans un tableau
     * @param array $skills la liste des compétences
     */
    public function displaySkillsList()
    {
        if (count($this->skills) > 0) {
            /* @var $skill Skill.php */
            foreach ($this->skills as $skill) {
                ?>
                <a class="ct competence-tag" data-competence-title="<?= $skill->getName() ?>"
                   id="ct-<?= $skill->getID() ?>"
                   href="#<?= $skill->getName() . "-" . $skill->getID() ?>">
                    <?= $skill->getName() ?>
                </a>
                <?php
                //echo "<a class=\"ct competence-tag\" data-competence-title=\"${skill}\" id=\"ct-${id}\" href=\"#${skill}-${id}\">${skill}</a>";
            }
        } else {
            echo "Il n'y a aucune compétence à afficher.";
        }
    }

    /**
     * Affiche la liste des compétences passées dans un tableau
     * @param array $skills la liste des compétences
     */
    public function displayAttachmentsList()
    {
        /** List of different files
         *
         * <a class="pf pf-word" href="" download="download">test_file.docx</a>
         * <a class="pf pf-pdf" href="" download="download">test_file.pdf</a>
         * <a class="pf pf-img" href="" download="download">test_file.png</a>
         * <a class="pf pf-default" href="" download="download">test_file.bin</a>
         */
        if (count($this->data) > 0) {
            /* @var $data Attachment.php */
            foreach ($this->data as $data) {
                ?>
                <a class="pf pf-<?= $data->getDocType() ?>" id="pf-<?= $data->getID() ?>" href=""
                   download="<?= $data->getName() ?>"><?= $data->getName() ?></a>
                <?php
            }
        } else {
            echo "Il n'y a aucune compétence à afficher.";
        }
    }

    /**
     * Affiche la description d'un projet
     * @param string $description la description du projet
     * @param int $id l'identifiant du projet
     */
    function displayDescription()
    {
        if (strlen($this->description) > 340) {
            $maxChars = 350;
            $strStart = substr($this->description, 0, $maxChars);
            $strEnd = substr($this->description, $maxChars);
            ?>
            <span class="description-start description-hidden" data-description-start="<?= $this->id ?>"><?= $strStart ?></span>
            <a class="show-more" data-description-id="<?= $this->id ?>" href="#pp-<?= $this->id ?>">En savoir plus</a>
            <span class="description-end" data-description-end="<?= $this->id ?>"><?= $strEnd ?></span>
        <?php } else {
            echo $this->description;
        }

    }
}