<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 17/07/2017
 * Time: 10:27
 */

namespace AppBundle\Controller;

use AppBundle\Data\Repository\ProductRepository;
use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(service="app.product_controller")
 */
class ProductController extends BaseController
{
    private $_productRepostory;

    function __construct(ProductRepository $productRepository)
    {
        $this->_productRepostory = $productRepository;
    }

/**
 * @Route("/list/product/{catId}/{limit}",name="app_product_list")
 * @Template("AppBundle:Product:list.html.twig")
 */
public function ListProduct($catId,$limit)
{
    $products = $this->_productRepostory->GetProductByCategory($catId,0,$limit);
    return array(
        'products' => $products
    );
}
    /**
     * @Route("/list/brand/{brandId}/{limit}",name="app_product_list_brand")
     * @Template("AppBundle:Product:list.html.twig")
     */
    public function ListProductBrand($brandId,$limit)
    {
        $products = $this->_productRepostory->GetProductByBrand($brandId,0,$limit);
        return array(
            'products' => $products
        );
    }
/**
 * @Route("/product/detail/{id}",name="app_product_detail")
 * @Template("AppBundle:Product:detail.html.twig")
 */
    public function ProductDetail($id)
    {
        $product = $this->_productRepostory->GetProductById($id);
        return array(
            'product' => $product
        );
    }
}