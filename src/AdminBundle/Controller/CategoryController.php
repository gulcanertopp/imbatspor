<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29.06.2017
 * Time: 15:40
 */

namespace AdminBundle\Controller;

use AdminBundle\Controller\BaseController;
use AppBundle\Data\Model\Category;
use AppBundle\Data\Repository\CategoryRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(service="admin.category_controller")
 */
class CategoryController extends BaseController
{
    private $_categoryRepository;

    function __construct( CategoryRepository $categoryRepository)
    {
        $this->_categoryRepository = $categoryRepository;

    }


    /**
     * @Route("/list/category",name="admin_category_list")
     * @Template("AdminBundle:Category:list.html.twig")
     */
    public function ListCategory()
    {
        $categories = $this->_categoryRepository->GetCategory();
        return array(
            'categories' => $categories
        );
    }

    /**
     * @Route("/list/subcategory/{parent}",name="admin_sub_category_list")
     * @Template("AdminBundle:Category:sub-cat-list.html.twig")
     */
    public function SubListCategory($parent)
    {
        $categories = $this->_categoryRepository->GetCategoryByParent($parent);
        return array(
            'categories' => $categories
        );
    }

    /**
     * @Route("/ajax/delete/category",name="ajax_admin_delete_category")
     * @param Request $request
     * @return array
     */
    public function DeleteCategory(Request $request)
    {
        $catid = $request->get('categoryID');
        $deleteCat = $this->_categoryRepository->DeleteCategory($catid);

        if ($deleteCat == false) {
            return new JsonResponse(array(
                'success' => false,
                'message' => 'Silme işlemi başarısız'
            ));

        }
        return new JsonResponse(array(
            'success' => true,
            'message' => 'Silindi'
        ));
        return true;
    }



    /**
     * @Route("/save/category",name="index_admin_save_category")
     * @Template("AdminBundle:Category:save.html.twig")
     */
    public function CategorySaveAction(Request $request)
    {
        $id = $request->get('id');
        if ($id == null)
            return array(
                'category' => false
            );

        return array(
            'category' => $this->_categoryRepository->GetCategoryById($id)
        );

    }

    /**
     * @Route("/save/subcategory",name="index_admin_save_subcategory")
     * @Template("AdminBundle:Category:sub-cat-save.html.twig")
     */
    public function SubCategorySaveAction(Request $request)
    {
        $id = $request->get('id');
        if ($id == null)
            return array(
                'category' => false,
                'categories' => $this->_categoryRepository->GetCategory()
            );

        return array(
            'category' => $this->_categoryRepository->GetCategoryById($id),
            'categories' => $this->_categoryRepository->GetCategory()
        );
    }

    /**
     * @Route("/ajax/save/category",name="ajax_cat_save")
     */
    public function AjaxSaveCategoryAction(Request $request)
    {
        $data = $request->request->all();
        //var_dump($data);exit();
        $category = (new Category())->MapFrom($data);

        $saveCat = $this->_categoryRepository->SaveCategory($category);

        if ($saveCat == false) {
            return new JsonResponse(array(
                'success' => false
            ));
        }

        return new JsonResponse(array(
            'success' => true
        ));
    }

}