<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 13/07/2017
 * Time: 14:26
 */

namespace AppBundle\Data\Model;


class ProductCategory
{
    public $_categoryID;
    public $_productID;

    /**
     * return ProductCategory
     */
   public function MapFrom(array $data){

       $this->_categoryID = data["category_id"];
       $this->_productID = data["product_id"];

       return $this;

   }

}