<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 07/07/2017
 * Time: 16:33
 */

namespace AppBundle\Data\Model;


class Brand
{
    public $ID;
    public $BrandName;
    public $Description;
    public $ImgUrl;

    public function MapFrom(array $data){

        $this->ID                    = $data["id"];
        $this->BrandName             = $data["brand_name"];
        $this->Description           = $data["description"];
        $this->ImgUrl                = $data["img_url"];

        return $this;
    }


}