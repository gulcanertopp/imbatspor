<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29.06.2017
 * Time: 15:40
 */

namespace AdminBundle\Controller;

use AppBundle\Data\Model\Product;
use AdminBundle\Controller\BaseController;
use AppBundle\Data\Repository\BrandRepository;
use AppBundle\Data\Repository\CategoryRepository;
use AppBundle\Data\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route(service="admin.product_controller")
 */
class ProductController extends BaseController
{
    public $_productRepository;
    public $_categoryReposityory;
    public $_brandReposityory;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    function __construct(ProductRepository $productRepository,CategoryRepository $categoryRepository , BrandRepository $brandRepository)
    {
        $this->_productRepository = $productRepository;
        $this->_categoryReposityory = $categoryRepository;
        $this->_brandReposityory = $brandRepository;

    }

    /**
     * @Route("/list/product/{limit}",name="admin_product_list")
     * @Template("AdminBundle:Product:list.html.twig")
     */
    public function ListProduct($limit){
        $products = $this->_productRepository->GetProduct(0,$limit);
      //  var_dump($products);exit();


        return array(
            'products' => $products
        );
    }

    /**
     * @Route("/add/product",name="index_admin_add_product")
     * @Template("AdminBundle:Product:add.html.twig")
     */
    public function ProductAddAction(Request $request)
    {

        return array(
            'categories' => $this->_categoryReposityory->GetCategory(),
            'brands' => $this->_brandReposityory->GetBrand()
        );
    }

    /**
     * @Route("/update/product/{id}",name="index_admin_update_product")
     * @Template("AdminBundle:Product:update.html.twig")
     */
    public function ProductUpdateAction($id)
    {
        $product = $this->_productRepository->GetProductById($id);

        return array(
            'product' => $product,
            'categories' => $this->_categoryReposityory->GetCategory(),
            'brands' => $this->_brandReposityory->GetBrand()

        );
    }
    /**
     * @Route("/ajax/add/product",name="ajax_product_add")
     */
    public function AjaxAddProductAction(Request $request)
    {
        $data = $request->request->all();
        $product = (new Product())->MapFrom($data);

        $saveProduct = $this->_productRepository->AddProduct($product);

        if ($saveProduct == false) {
            return new JsonResponse(array(
                'success' => false
            ));
        }

        return new JsonResponse(array(
            'success' => true
        ));
    }
    /**
     * @Route("/ajax/add/update",name="ajax_product_update")
     */
    public function AjaxUpdateProductAction(Request $request)
    {
        $data = $request->request->all();
        $product = (new Product())->MapFrom($data);

       // var_dump($product->Categories);exit;

        $saveProduct = $this->_productRepository->UpdateProduct($product);

        if ($saveProduct == false) {
            return new JsonResponse(array(
                'success' => false
            ));
        }

        return new JsonResponse(array(
            'success' => true
        ));
    }

    /**
     * @Route("/ajax/delete/prodcut",name="ajax_admin_delete_product")
     * @param Request $request
     * @return array
     */
    public function DeleteProduct(Request $request)
    {
        $product_id = $request->get('productID');
        $deleteProduct = $this->_productRepository->DeleteProduct($product_id);

        if ($deleteProduct == false) {
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
     * @Route("/ajax/get/subcategory/",name="admin_ajax_sub_category_get")
     */
    public function GetSubCategoryProduct(Request $request)
    {
        $parent = $request->request->get('parent');
        $categories = $this->_categoryReposityory->GetCategoryByParent($parent);
        return new JsonResponse( array(
            'categories' => $categories
        ));
    }
}