<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 14:15
 */

class Establishment
{
    public $id;
    public $name;
    public $city;

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

    public static function withNameCity($name, $city)
    {
        $instance = new self();
        $instance->name = $name;
        $instance->city = $city;
        return $instance;
    }

    protected function loadByID() {
        $result = getQuery("getEstablishment", array("id_establishment", $this->id));
        $this->fill($result);
    }

    protected function fill( array $array ) {
        $this->name = $array['name'];
        $this->city = $array['city'];
    }

    public function getName() {
        return $this->name;
    }

    public function getCity() {
        return $this->city;
    }

}