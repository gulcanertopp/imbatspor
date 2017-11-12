<?php
namespace AppBundle\Data\Model;

class User
{

    public $ID;
    public $UserName;
    public $Password;


    /**
     * return User
     */
    public function MapFrom(array $data)
    {

        $this->ID               = $data["id"];
        $this->UserName         = $data["user_name"];
        $this->Password         = $data["password"];

        return $this;
    }

}
