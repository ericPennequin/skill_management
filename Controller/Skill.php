<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 16:24
 */

class Skill
{
    public $id;
    public $projectID;
    public $name;

    /**
     * Skill constructor.
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
        $_REQUEST['command'] = "getSkill";
        $_REQUEST['id_skill'] = $this->id;
        $result = array();
        include "../Model/Querys.php";
        $this->fill($result);
    }

    protected function fill(array $array)
    {
        $this->projectID = $array['id_skill'];
        $this->name = $array['name'];
    }
}