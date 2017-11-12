<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29.06.2017
 * Time: 15:09
 */

namespace AppBundle\Data\Model;


class Customer
{
    public $ID;
    public $Firstname;
    public $Lastname;
    public $Password;
    public $Email;
    public $Phone;
    public $Adress;
    public $Description;


    /**
     * return Customer
     */
    public function MapFrom(array $data)
    {
        $this->ID                 = $data["id"];
        $this->Firstname          = $data["firstname"];
        $this->Lastname           = $data["lastname"];
        $this->Password           = $data["password"];
        $this->Email              = $data["email"];
        $this->Phone              = $data["phone"];
        $this->Adress             = $data["address"];
        $this->Description        = $data["description"];


    }

}