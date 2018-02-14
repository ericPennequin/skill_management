<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 12:20
 */

require "Establishment.php";
require "ProjectsList.php";

class Person
{
    public $id;

    // attributs
    public $firstName;
    public $lastName;
    public $email;
    public $cellNumber;
    public $profilPic;
    public $status;

    // Etablissement(id, name, city)
    public $establishment;

    // Project
    public $projects; // liste de Projects

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
        $_REQUEST['command'] = "profilViewer";
        $_REQUEST['id_person'] = $this->id;
        $result = array();
        include "../Model/Querys.php";

        $this->fillAttributs($result["userData"]);
    }

    public function fillAttributs(array $array)
    {
        print_r($array);
        $this->firstName = $array["firstname"];
        $this->lastName = $array["lastname"];
        $this->email = $array["email"];
        $this->cellNumber = $array["cell_number"];
        $this->profilPic = $array["picture"];
        $this->status = $array["status"];

        $this->establishment = Establishment::withID($array["id_establishment"]);

        $this->projects = new ProjectsList($array["id_establishment"]);

        print_r($this);
    }


    /*
     *
 *      firstname
 *      lastname
 *      email
 *      cell_number
 *      id_establishment
 *      name (establishment)
 *      city (establishment)
 *      projects [ARRAY, id = id_project]
 *          id_project
 *          name
 *          description
 *          status
 *          data [ARRAY]
 *              id_data
 *              data
 *          skills [ARRAY]
 *              id_skill
 *              name
     */

}