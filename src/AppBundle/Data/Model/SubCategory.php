<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29.06.2017
 * Time: 14:35
 */

namespace AppBundle\Data\Model;


class SubCategory
{
    public $ID;
    public $CategoryName;
    public $Description;
    public $Parent;

    /**
     * return Category
     */
    public function MapFrom(array $data){

         $this->ID              = $data["id"];
         $this->CategoryName    = $data["category_name"];
         $this->Description     = $data["description"];
         $this->Parent          = $data["parent"];

         return $this;
    }

}