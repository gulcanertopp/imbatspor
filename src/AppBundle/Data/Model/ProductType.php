<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 13/07/2017
 * Time: 13:34
 */

namespace AppBundle\Data\Model;


use Symfony\Component\Config\Definition\Exception\Exception;

class ProductType
{
    public $ProductTypeID;

    public function MapFrom(array $data, $context){
        try{
            switch ($context)
            {
                case ContextType::DB:
                    $this->ProductTypeID = $data['product_type_id'];

                    return $this;
                default:
                    throw new Exception("Error");
                    break;
            }
        }catch (\Exception $e){
            return false;
        }

    }
}