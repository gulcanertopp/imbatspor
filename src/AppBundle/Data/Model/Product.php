<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29.06.2017
 * Time: 14:55
 */

namespace AppBundle\Data\Model;


class Product
{
    public $ID;
    public $ProductCode;
    public $ProductName;
    public $Price;
    public $Description;
    public $Gender;
    public $BrandID;
    public $ImgUrl;

    public $Categories;
    /**
     * return Product
     */
    public function MapFrom(array $data){

        $this->ID                = $data["id"];
        $this->ProductCode       = $data["product_code"];
        $this->ProductName       = $data["product_name"];
        $this->Price             = $data["price"];
        $this->Description       = $data["description"];
        $this->Gender            = $data["gender"];
        $this->BrandID           = $data["brand_id"];
        $this->ImgUrl            = $data["img_url"];

        $this->Categories = array();
        if(array_key_exists('categories',$data))
        {

            foreach ($data['categories'] as $row)
            {
                $this->Categories[] = (new Category())->MapFrom($row);
            }
        }

        return $this;
    }

}