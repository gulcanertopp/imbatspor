<?php
/**
 * Created by PhpStorm.
 * User: alper
 * Date: 22/07/2017
 * Time: 16:11
 */

namespace AdminBundle\Controller;

use AppBundle\Data\Model\Brand;
use AppBundle\Data\Repository\BrandRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route(service="admin.brand_controller")
 */
class BrandController extends BaseController
{
    private $_brandRepository;

    function __construct(BrandRepository $brandRepository)
    {
        $this->_brandRepository = $brandRepository;
    }


    /**
     * @Route("/list/brand",name="admin_brand_list")
     * @Template("AdminBundle:Brand:list.html.twig")
     */
    public function ListBrand()
    {
        $brands = $this->_brandRepository->GetBrand();
        return array(
            'brands' => $brands
        );
    }

    /**
     * @Route("/save/brand",name="index_admin_save_brand")
     * @Template("AdminBundle:Brand:save.html.twig")
     */
    public function BrandSaveAction(Request $request)
    {
        $id = $request->get('id');
        if ($id == null)
            return array(
                'brand' => false
            );

        return array(
            'brand' => $this->_brandRepository->GetBrandById($id)
        );

    }

    /**
     * @Route("/ajax/save/brand",name="ajax_brand_save")
     */
    public function AjaxSaveBrandAction(Request $request)
    {
        $data = $request->request->all();
        $brand = (new Brand())->MapFrom($data);
        //var_dump($brand);exit();

        $saveBrand = $this->_brandRepository->SaveBrand($brand);

        if ($saveBrand == false) {
            return new JsonResponse(array(
                'success' => false
            ));
        }

        return new JsonResponse(array(
            'success' => true
        ));
    }

    /**
     * @Route("/ajax/delete/brand",name="ajax_admin_delete_brand")
     * @param Request $request
     * @return array
     */
    public function DeleteBrand(Request $request)
    {
        $brandId = $request->get('id');;
        $deleteBrand = $this->_brandRepository->DeleteBrand($brandId);

        if ($deleteBrand == false) {
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
}