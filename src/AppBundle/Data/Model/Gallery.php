<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 17/07/2017
 * Time: 15:19
 */

namespace AppBundle\Data\Model;


class Gallery
{

    public $ID;
    public $ImageURL;
    public $Description;
    public $Title;

    /**
     * return Product
     */
    public function MapFrom(array $data){
        $this->ID                = $data["id"];
        $this->ImageURL          = $data["image_url"];
        $this->Description       = $data["description"];
        $this->Description       = $data["title"];

        return $this;
    }
}