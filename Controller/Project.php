<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 14:16
 */

class Project
{
    public $id;
    public $idEtablishment;

    public $name;
    public $description;
    public $status;

    public $skills;

    public $data;

    /**
     * Establishment constructor.
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
        $_REQUEST['command'] = "getProject";
        $_REQUEST['id_project'] = $this->id;
        $result = array();
        include "../Model/Querys.php";
        $this->fill($result);
    }

    protected function fill(array $array)
    {
        $this->idEtablishment = $array['id_establishment'];
        $this->name = $array['name'];
        $this->description = $array['description'];
        $this->status = $array['status'];

        $this->skills = [];
        $this->data = [];
    }
}