<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 15:59
 */

class Attachment
{
    public $id;
    public $projectID;
    //public $name;
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
        $_REQUEST['command'] = "getAttachment";
        $_REQUEST['id_attachment'] = $this->id;
        $result = array();
        include "../Model/Querys.php";
        $this->fill($result);
    }

    protected function fill(array $array)
    {
        $this->projectID = $array['id_project'];
        //$this->name = $array['name'];
        $this->data = $array['data'];
    }
}