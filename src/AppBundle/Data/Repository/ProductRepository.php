<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 07/07/2017
 * Time: 17:40
 */

namespace AppBundle\Data\Repository;
use AppBundle\Data\Model\Product;
use AppBundle\Domain\Model\PagedList;
use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\Config\Definition\Exception\Exception;



class ProductRepository extends BaseRepository
{
    /**
     * @param Product $product
     * @return bool
     */

    //Product Kaydet
    public function AddProduct(Product $product)
    {
        try {

            $query = 'INSERT INTO product 
                      (product_code,product_name,price,description,brand_id,gender,img_url) VALUES
                      (:product_code,:product_name,:price,:description,:brand_id,:gender,:img_url)';

            $result = $this->getConnection()->prepare($query);
          //  var_dump($query);exit();
            $result->execute(array(
                ':product_code' => $product->ProductCode,
                ':product_name' => $product->ProductName,
                ':price' => $product->Price,
                ':description' => $product->Description,
                ':brand_id' => $product->BrandID,
                ':gender' => $product->Gender,
                ':img_url' => $product->ImgUrl
            ));


            if($product->ID == null)
                $product->ID =  intval($this->getConnection()->lastInsertId());

            if ($result == false)
                return false;

            $catQuery="INSERT INTO product_category
                          (product_id, category_id) VALUES ";

            $numItems = count($product->Categories);
            $i = 0;


            foreach ($product->Categories as $category)
            {
                if (++$i === $numItems)
                {
                    $catQuery.="(".$product->ID.",".$category->ID.")";
                }else{
                    $catQuery.="(".$product->ID.",".$category->ID."),";
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
    public function UpdateProduct(Product $product)
    {
        try {

            $query = 'UPDATE product SET 
            product_code = :product_code, product_name = :product_name, price = :price, description = :description,brand_id = :brand_id,gender = :gender,img_url = :img_url
            WHERE id = ' . $product->ID;

            $result = $this->getConnection()->prepare($query);
            //  var_dump($query);exit();
            $result->execute(array(
                ':product_code' => $product->ProductCode,
                ':product_name' => $product->ProductName,
                ':price' => $product->Price,
                ':description' => $product->Description,
                ':brand_id' => $product->BrandID,
                ':gender' => $product->Gender,
                ':img_url' => $product->ImgUrl
            ));


            if ($result == false)
                return false;
            $deleteCat = 'DELETE FROM product_category
                          WHERE product_id = '. $product->ID;

            $deleteResult = $this->getConnection()->prepare($deleteCat);
            $deleteResult->execute();

            if ($deleteResult == false)
                return false;

            $catQuery="INSERT INTO product_category
                          (product_id, category_id) VALUES ";

            $numItems = count($product->Categories);
            $i = 0;


            foreach ($product->Categories as $category)
            {
                if (++$i === $numItems)
                {
                    $catQuery.="(".$product->ID.",".$category->ID.")";
                }else{
                    $catQuery.="(".$product->ID.",".$category->ID."),";
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



    public function DeleteProduct($productId)
    {
        try {

            $deleteCat = 'DELETE FROM product_category
                          WHERE product_id = '. $productId;

            $deleteResult = $this->getConnection()->prepare($deleteCat);
            $deleteResult->execute();

            if ($deleteResult == false)
                return false;

            $query = 'DELETE FROM product
                          WHERE id = '. $productId;

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if ($result == false)
                return false;

            return true;
        } catch (Exception $e){
            return false;
        }
    }
        //Product Listele
        public function GetProduct($offset = 0, $limit = 5)
        {
        try{
            $countQuery='SELECT COUNT(*) as row_count 
                FROM product';

            $countResult = $this->getConnection()->prepare($countQuery);
            $countResult->execute();

            $countResult = $countResult->fetch();

            if($countResult === null || (int)$countResult['row_count'] == 0)
                return new PagedList(null,0,$limit);



            $query = 'SELECT * FROM product
                      LIMIT '.$offset.','.$limit;

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return new PagedList(null, 0,$limit);

            $results=$result->fetchAll();

            $catQuery='SELECT  
                      c.*
                   FROM product p 
                   INNER JOIN product_category pc on pc.product_id = p.id
                   INNER JOIN category c on pc.category_id = c.id
                   WHERE p.id = :productId';


            $resultCat = $this->getConnection()->prepare($catQuery);


            $products = array();

            foreach ($results as $result){
                $resultCat->execute(array(
                    ':productId'=>$result["id"]
                ));

                $result['categories']=$resultCat->fetchAll();

                $products[] =(new Product())->MapFrom($result);

            }

            $list = new PagedList($products,(int)$countResult['row_count'],$limit);

            return $list;

        }
        catch (Exception $e){
            return false;
        }

    }

    public function GetProductByCategory($catId,$offset = 0, $limit = 5)
    {
        try{
            $countQuery='SELECT COUNT(*) as row_count 
                FROM product';

            $countResult = $this->getConnection()->prepare($countQuery);
            $countResult->execute();

            $countResult = $countResult->fetch();

            if($countResult === null || (int)$countResult['row_count'] == 0)
                return new PagedList(null,0,$limit);


            $query = 'SELECT p.* FROM product p
                      INNER JOIN product_category pc ON pc.product_id = p.id
                      WHERE pc.category_id = '.$this->getConnection()->quote($catId).' 
                      LIMIT '.$offset.','.$limit;
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return new PagedList(null, 0,$limit);

            $results=$result->fetchAll();


            $catQuery='SELECT  
                      c.*
                   FROM product p 
                   INNER JOIN product_category pc on pc.product_id = p.id
                   INNER JOIN category c on pc.category_id = c.id
                   WHERE p.id = :productId';


            $resultCat = $this->getConnection()->prepare($catQuery);


            $products = array();

            foreach ($results as $result){
                $resultCat->execute(array(
                    ':productId'=>$result["id"]
                ));

                $result['categories']=$resultCat->fetchAll();

                $products[] =(new Product())->MapFrom($result);

            }
            $list = new PagedList($products,(int)$countResult['row_count'],$limit);

            return $list;

        }
        catch (Exception $e){
            return false;
        }

    }

    public function GetProductByBrand($brandId,$offset = 0, $limit = 5)
    {
        try{
            $countQuery='SELECT COUNT(*) as row_count 
                FROM product 
                WHERE brand_id = '.$this->getConnection()->quote($brandId);

            $countResult = $this->getConnection()->prepare($countQuery);
            $countResult->execute();

            $countResult = $countResult->fetch();

            if($countResult === null || (int)$countResult['row_count'] == 0)
                return new PagedList(null,0,$limit);


            $query = 'SELECT p.* FROM product p
                      WHERE p.brand_id = '.$this->getConnection()->quote($brandId).' 
                      LIMIT '.$offset.','.$limit;
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return new PagedList(null, 0,$limit);

            $results=$result->fetchAll();



            $catQuery='SELECT  
                      c.*
                   FROM product p 
                   INNER JOIN product_category pc on pc.product_id = p.id
                   INNER JOIN category c on pc.category_id = c.id
                   WHERE p.id = :productId';


            $resultCat = $this->getConnection()->prepare($catQuery);


            $products = array();

            foreach ($results as $result){
                $resultCat->execute(array(
                    ':productId'=>$result["id"]
                ));

                $result['categories']=$resultCat->fetchAll();

                $products[] =(new Product())->MapFrom($result);

            }
            $list = new PagedList($products,(int)$countResult['row_count'],$limit);

            return $list;

        }
        catch (Exception $e){
            return false;
        }

    }

    public function GetProductById($id)
    {
        try{
            $query = 'SELECT * FROM product
                      WHERE id ='.$id;
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return false;

            $result=$result->fetch();

            $catQuery='SELECT  
                      c.*
                   FROM product p 
                   INNER JOIN product_category pc on pc.product_id = p.id
                   INNER JOIN category c on pc.category_id = c.id
                   WHERE p.id = :productId';


            $resultCat = $this->getConnection()->prepare($catQuery);

                $resultCat->execute(array(
                    ':productId'=>$result["id"]
                ));

                $result['categories']=$resultCat->fetchAll();

                $result =(new Product())->MapFrom($result);

            return $result;

        }
        catch (Exception $e){
            return false;
        }

    }


}