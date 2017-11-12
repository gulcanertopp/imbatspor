<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29/07/2017
 * Time: 16:23
 */

namespace AppBundle\Data\Model;


class Catalog
{

    public $ID;
    public $CatalogName;
    public $ImgUrl;
    public $PdfUrl;


    /**
     * return User
     */
    public function MapFrom(array $data)
    {

        $this->ID             = $data["id"];
        $this->CatalogName    = $data["catalog_name"];
        $this->ImgUrl         = $data["img_url"];
        $this->PdfUrl         = $data["pdf_url"];

        return $this;
    }
}