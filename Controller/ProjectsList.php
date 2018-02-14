<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 15:06
 */

require "Project.php";

class ProjectsList
{
    public $idEstablishment;
    public $projects;

    /**
     * ProjectsList constructor.
     * @param int $idEstablishment
     */
    public function __construct($idEstablishment)
    {
        $this->idEstablishment = $idEstablishment;
        $this->projects = $this->getProjects();
    }

    protected function getProjects()
    {
        $_REQUEST['command'] = "getProjectsList";
        $_REQUEST['id_establishment'] = $this->idEstablishment;
        $result = array();
        echo "iodjsfdknsr";
        include "../Model/Querys.php";

        $list = [];
        foreach ($result as $projectID) {
            $list[] = Project::withID($projectID);
        }

        return $list;
    }
}