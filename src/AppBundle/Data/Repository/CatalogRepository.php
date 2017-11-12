<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29/07/2017
 * Time: 16:22
 */

namespace AppBundle\Data\Repository;
use AppBundle\Data\Model\Catalog;
use Symfony\Component\Config\Definition\Exception\Exception;



class CatalogRepository extends BaseRepository
{
    /**
     * @param Catalog $catalog
     * @return bool
     */

    //Katalog Kaydet
    public function SaveCatalog(Catalog $catalog)
    {
        try
        {
            $query = 'INSERT INTO catalog 
                      (catalog_name,img_url,pdf_url) VALUES
                      (:catalog_name,:img_url,:pdf_url)';

            $result = $this->getConnection()->prepare($query);
             //var_dump($query);exit();
            $result->execute(array(
                ':catalog_name' => $catalog->CatalogName,
                ':img_url' => $catalog->ImgUrl,
                ':pdf_url' => $catalog->PdfUrl,
            ));

            if($catalog->ID == null)
                $catalog->ID =  intval($this->getConnection()->lastInsertId());

            if ($result == false)
                return false;

            return true;
    } catch(Exception $e){
        return false;
    }

    }

    //Katalog Listele
    public function GetCatalog()
    {
        try {
            $query = 'SELECT * FROM catalog';

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if ($result == false)
                return false;

            $results = $result->fetchAll();
            $catalogs = array();

            foreach ($results as $result) {

                $catalogs[] = (new Catalog())->MapFrom($result);

            }

            return $catalogs;

        } catch (Exception $e) {
            return false;
        }
    }

    //Katalog GETbyID
        public function GetCatalogById($id)
    {
        try{
            $query = 'SELECT * FROM catalog
                      WHERE id = '.$id;
            $result = $this->getConnection()->prepare($query);
            $result->execute();
            $results = $result->fetch();

            if($results === false)
                return false;

            $catalog = (new Catalog())->MapFrom($results);;

            return $catalog;
        }
        catch (Exception $e){
            return false;
        }
    }

    public function GetPdfById($id)
    {
        try{
            $query = 'SELECT pdf_url FROM catalog 
                      WHERE id =' .$id;
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            return $result;
        }
        catch (Exception $e){
            return false;
        }
    }

    public function UpdateCatalog(Catalog $catalog)
    {
        try {

            $query = 'UPDATE catalog SET 
           catalog_name = :catalog_name,img_url = :img_url,pdf_url = :pdf_url
            WHERE id = ' . $catalog->ID;

            $result = $this->getConnection()->prepare($query);
            //  var_dump($query);exit();
            $result->execute(array(
                ':catalog_name' => $catalog->CatalogName,
                ':img_url' => $catalog->ImgUrl,
                ':pdf_url' => $catalog->PdfUrl
            ));


            if ($result == false)
                return false;
            $deleteCat = 'DELETE FROM catalog
                          WHERE catalog_id = '. $catalog->ID;

            $deleteResult = $this->getConnection()->prepare($deleteCat);
            $deleteResult->execute();

            if ($deleteResult == false)
                return false;

            $catQuery="INSERT INTO catalog
                          (catalog_id) VALUES ";

            $numItems = count($catalog->Catalogs);
            $i = 0;


            foreach ($catalog->Catalogs as $catalogs)
            {
                if (++$i === $numItems)
                {
                    $catQuery.="(".$catalog->ID.",".$catalog->ID.")";
                }else{
                    $catQuery.="(".$catalog->ID.",".$catalog->ID."),";
                }
            }

            $catResult = $this->getConnection()->prepare($catQuery);
            $catResult->execute();
            if($catResult === false)
                return false;

            return true;
        } catch (Exception $e){
            return false;
        }
    }

}