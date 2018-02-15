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
    protected $name;

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
        $result = getQuery("getSkill", array("id_skill", $this->id));
        $this->fill($result);
    }

    protected function fill(array $array)
    {
        $this->name = $array['name'];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



}