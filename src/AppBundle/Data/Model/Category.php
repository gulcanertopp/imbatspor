<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29.06.2017
 * Time: 14:35
 */

namespace AppBundle\Data\Model;


class Category
{
    public $ID;
    public $CategoryName;
    public $Description;
    public $Parent;
    public $ParentName;

    public $SubCategories;

    /**
     * return Category
     */
    public function MapFrom(array $data){

        //var_dump($data);

         $this->ID              = $data["id"];
         $this->CategoryName    = $data["category_name"];
         $this->Description     = $data["description"];
         $this->Parent          = $data["parent"];

        $this->SubCategories = array();
        if(array_key_exists('subcategories',$data))
        {
            foreach ($data['subcategories'] as $row)
            {
                $this->SubCategories[] = (new SubCategory())->MapFrom($row);
            }
        }

        if(array_key_exists('parentName',$data)){
            $this->ParentName = $data['parentName'];
        }

         return $this;
    }

}