<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 29/07/2017
 * Time: 16:18
 */

namespace AdminBundle\Controller;

use AdminBundle\Controller\BaseController;
use AppBundle\Data\Model\Catalog;
use AppBundle\Data\Repository\CatalogRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route(service="admin.catalog_controller")
 */
class CatalogController extends BaseController
{
    private $_catalogRepository;

    function __construct(CatalogRepository $catalogRepository)
    {
        $this->_catalogRepository = $catalogRepository;
    }

    /**
     * @Route("/list/catalog",name="admin_catalog_list")
     * @Template("AdminBundle:Catalog:list.html.twig")
     */
    public function ListCatalog()
    {
        $catalogs = $this->_catalogRepository->GetCatalog();
        return array(
            'catalogs' => $catalogs
        );
    }

    /**
     * @Route("/save/catalog",name="index_admin_save_catalog")
     * @Template("AdminBundle:Catalog:save.html.twig")
     */
    public function CatalogSaveAction(Request $request)
    {
        $id = $request->get('id');
        if ($id == null)
            return array(
                'catalog' => false
            );

        return array(
            'catalog' => $this->_catalogRepository->GetCatalogById($id)
        );

    }

    /**
     * @Route("/ajax/delete/catalog",name="ajax_admin_delete_catalog")
     * @param Request $request
     * @return array
     */
    public function DeleteCatalog(Request $request)
    {
        $catalogId = $request->get('id');;
        $deleteCatalog = $this->_catalogRepository->DeleteCatalog($catalogId);

        if ($deleteCatalog == false) {
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
     * @Route("/ajax/save/catalog",name="ajax_catalog_save")
     */
    public function AjaxSaveCatalogAction(Request $request)
    {
        $data = $request->request->all();
        $catalog = (new Catalog())->MapFrom($data);
        //var_dump($catalog);exit();

        $saveCatalog = $this->_catalogRepository->SaveCatalog($catalog);

        if ($saveCatalog == false) {
            return new JsonResponse(array(
                'success' => false
            ));
        }
        return new JsonResponse(array(
            'success' => true
        ));
    }


    /**
     * @Route("/update/catalog/{id}",name="index_admin_update_catalog")
     * @Template("AdminBundle:Catalog:update.html.twig")
     */
    public function CatalogUpdateAction($id)
    {
        $catalog = $this->_catalogRepository->GetProductById($id);

        return array(
            'catalog' => $catalog,
            'catalogs' => $this->_catalogRepository->GetCatalog(),


        );
    }

    /**
     * @Route("/ajax/add/update",name="ajax_catalog_update")
     */
    public function AjaxUpdateCatalogAction(Request $request)
    {
        $data = $request->request->all();
        $catalog = (new Catalog())->MapFrom($data);

        // var_dump($product->Categories);exit;

        $saveCatalog = $this->_catalogRepository->UpdateCatalog($catalog);

        if ($saveCatalog == false) {
            return new JsonResponse(array(
                'success' => false
            ));
        }

        return new JsonResponse(array(
            'success' => true
        ));
    }
}