<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 17/07/2017
 * Time: 15:16
 */

namespace AppBundle\Data\Repository;
use AppBundle\Data\Model\Category;
use AppBundle\Data\Model\Gallery;
use Symfony\Component\Config\Definition\Exception\Exception;

class GalleryRepository extends BaseRepository
{
    /**
     * @param Gallery $gallery
     * @return bool
     */

    //Image Kaydet
    public function SaveImage(Gallery $gallery)
    {
        try {
            $this->getConnection()->beginTransaction();
            $query = "";
            if($gallery->ID == null)
            {
                $query = "INSERT INTO `gallery`
                         (`title`, `description`, `image_url`) VALUES
                         (:title, :description, :image_url)";

            }else
            {
                $query = "UPDATE `gallery` SET 
                         `title`=:title,`description`=:description,`image_url`=:image_url
                         WHERE ID = ".$this->getConnection()->quote($gallery->ID);
            }

            $result = $this->getConnection()->prepare($query);
            $result->execute(array(
                'title'          => $gallery->Title,
                'description'    => $gallery->Description,
                'image_url'      => $gallery->ImageUrl
                ));

            if($result === false)
                return false;
            $this->getConnection()->commit();
                return true;
        }catch (\Exception $e)
        {
            $this->getConnection()->rollBack();
            return false;
        }
    }

    //Image Getir
    /**
     * @param $id
     * @return $this|bool
     */
    public function GetImage()
    {
        try{
            $query = 'SELECT * FROM gallery';
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return false;

            $results=$result->fetchAll();
            $images = array();

            foreach ($results as $result){

                $images[] =(new Gallery())->MapFrom($result);

            }
            return $images;

        }
        catch (Exception $e){
            return false;
        }
    }
    //Image Sil
    public function DeleteImage($id)
    {
        try{
            $this ->getConnection()->beginTransaction();
            $query = 'DELETE FROM gallery
                      WHERE id = '.$id;

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return false;
            $this->getConnection()->commit();

            return true;
        } catch (Exception $e){
            $this->getConnection()->rollBack();
            return false;
        }
    }

}