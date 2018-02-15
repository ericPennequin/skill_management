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
    public $name;
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
        $result = getQuery("getAttachment", array("id_attachment", $this->id));
        $this->fill($result);
    }

    protected function fill(array $array)
    {
        $this->data = $array['data'];
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

    /**
         * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


}