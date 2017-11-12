<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 07/07/2017
 * Time: 17:58
 */

namespace AppBundle\Data\Repository;
use AppBundle\Data\Model\Brand;


/**
 * @param Brand $brand
 * @return bool
 */
class BrandRepository extends BaseRepository
{
    //Brand Kaydet
    public function SaveBrand(Brand $brand)
    {
        try {
            if ($brand->ID == 'null') {
                $query = 'INSERT INTO brand (brand_name,description,img_url) VALUES (:brand_name,:description, :img_url)';
            } else {
                $query = 'UPDATE brand SET brand_name = :brand_name, description = :description , img_url = :img_url
                              WHERE id = ' . $brand->ID;
            }
            $result = $this->GetConnection()->prepare($query);
            $result->execute(array(
                ':brand_name' => $brand->BrandName,
                ':description' => $brand->Description,
                ':img_url' => $brand->ImgUrl
            ));
            if ($result == false)
                return false;

            return true;
        } catch (Exception $e){
            return false;
        }
    }



    //Brand Listele
    public function GetBrand()
    {
        try{
            $query = 'SELECT * FROM brand';
            $result = $this->getConnection()->prepare($query);
            $result->execute();
            $results = $result->fetchAll();

            if($results === false)
                return false;
            $brands = array();

            foreach ($results as &$result)
            {
                $brands[] = (new Brand())->MapFrom($result);
            }

            return $brands;
        }
        catch (Exception $e){
            return false;
        }

    }

    public function GetBrandById($id)
    {
        try{
            $query = 'SELECT * FROM brand
                      WHERE id = '.$id;
            $result = $this->getConnection()->prepare($query);
            $result->execute();
            $results = $result->fetch();

            if($results === false)
                return false;

            $brand = (new Brand())->MapFrom($results);;

            return $brand;
        }
        catch (Exception $e){
            return false;
        }

    }

    //Brand Sil
    public function DeleteBrand($id)
    {
        try{
            $query = 'DELETE FROM brand
                      WHERE id = '.$id;

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return false;

            return true;
        } catch (Exception $e){
            return false;
        }
    }


}