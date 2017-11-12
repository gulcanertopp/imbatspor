<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 07/07/2017
 * Time: 15:47
 */

namespace AppBundle\Data\Repository;
use AppBundle\Data\Model\Category;
use Symfony\Component\Config\Definition\Exception\Exception;


class CategoryRepository extends BaseRepository
{

    /**
     * @param Category $category
     * @return bool
     */

    //Kategori Kaydet
    public function SaveCategory(Category $category)
    {
        try {
            if ($category->ID == 'null') {
                $query = 'INSERT INTO category (category_name,description,parent) VALUES (:category_name,:description,:parent)';
            } else {
                $query = 'UPDATE category SET category_name = :category_name, description = :description, parent = :parent
                              WHERE id = ' . $category->ID;
            }
            $result = $this->GetConnection()->prepare($query);
            $result->execute(array(
                ':category_name'    => $category->CategoryName,
                ':description'      => $category->Description,
                ':parent'           => $category->Parent
                            ));

            if ($result == false)
                return false;

            return true;
        } catch (Exception $e){
            return false;
        }
    }


    //Kategori Listele
    public function GetCategory()
    {
        try{
            $query = 'SELECT * FROM category 
                      WHERE parent = 0';
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return false;

            $results=$result->fetchAll();
            $categories = array();

            foreach ($results as $result){

                $categories[] =(new Category())->MapFrom($result);

            }
            return $categories;

        }
        catch (Exception $e){
            return false;
        }

    }


    //Kategori Listele
    public function GetCategoryWithSub()
    {
        try{
            $query = 'SELECT * FROM category
                      WHERE parent = 0';
            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if($result == false)
                return false;

            $results=$result->fetchAll();

            $subQuery = 'SELECT * FROM category
                        WHERE parent = :parent';

            $subResult = $this->getConnection()->prepare($subQuery);

            $categories = array();

            foreach ($results as $result){
                $subResult->execute(array(
                    ':parent'=>$result["id"]
                ));
                $result["subcategories"] = $subResult->fetchAll();



                $categories[] =(new Category())->MapFrom($result);

            }
            return $categories;

        }
        catch (Exception $e){
            return false;
        }

    }

    //Kategori Sil
    public function DeleteCategory($id)
    {
      try{
          $this ->getConnection()->beginTransaction();
          $query = 'DELETE FROM category
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

    /**
     * @param $ID
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function GetCategoryById($id)
    {
        try{
            $query= 'SELECT 
                        *
                FROM category 
                WHERE id = '.$id;

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            $result = $result->fetch();
            //var_dump($result);exit;
            //var_dump($result);exit;
            if ($result === false)
                return false;

            return (new Category())->MapFrom($result);
        }catch (Exception $e)
        {
            return false;
        }
    }
    /**
     * @param $ID
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function GetCategoryByParent($parent)
    {
        try{
            $query= 'SELECT 
                        *
                FROM category 
                WHERE parent = '.$parent;

            $result = $this->getConnection()->prepare($query);
            $result->execute();

            if ($result === false)
                return false;

            $results=$result->fetchAll();
            $categories = array();

            $parentQuery= 'SELECT 
                        *
                FROM category 
                WHERE ID = '.$parent;

            $parentResult = $this->getConnection()->prepare($parentQuery);
            $parentResult->execute();

            if ($parentResult === false)
                return false;

            $parentResult=$parentResult->fetch();

            foreach ($results as $result){
                $result['parentName'] = $parentResult['category_name'];
                $categories[] =(new Category())->MapFrom($result);

            }
            return $categories;

        }catch (Exception $e)
        {
            return false;
        }
    }
    public function GetKeyCategory($key)
    {
        try{
            $query='SELECT
                    c.id,
                    c.category_name
                FROM category c
                WHERE category_name
                LIKE "%'.$key.'%"';

            $result = $this->getConnection()->prepare($query);
            $result->execute();
            $results = $result->fetchAll();

            if($results === false)
                return false;
            $categories = array();

            foreach ($results as &$result)
            {
                $categories[] = (new Category())->MapFrom($result);
            }

            return $categories;

        }catch (Exception $e)
        {
            return false;
        }

    }
}