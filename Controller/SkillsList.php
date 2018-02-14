<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 16:23
 */

require "Skill.php";

class SkillsList
{
    public $id;
    public $idProject;
    public $skills;

    /**
     * SkillsList constructor.
     * @param int $idProject
     */
    public function __construct($idProject)
    {
        $this->idProject = $idProject;
        $this->skills = $this->getSkills();
    }

    protected function getSkills()
    {
        $_REQUEST['command'] = "getSkillsList";
        $_REQUEST['id_project'] = $this->idProject;
        $result = array();
        include "../Model/Querys.php";

        $list = [];
        foreach ($result as $skillID) {
            $list[] = Skill::withID($skillID);
        }

        return $list;
    }
}