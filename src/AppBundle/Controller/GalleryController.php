<?php
/**
 * Created by PhpStorm.
 * User: gulcanertop
 * Date: 17/07/2017
 * Time: 13:19
 */

namespace AppBundle\Controller;

use AppBundle\Data\Repository\GalleryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(service="app.gallery_controller")
 */
class GalleryController extends BaseController
{
    private $_galleryRepostory;

    function __construct(GalleryRepository $galleryRepository)
    {
        $this->_galleryRepostory = $galleryRepository;
    }

    /**
     * @Route("/list/gallery",name="app_gallery_list")
     * @Template("AppBundle:Gallery:list.html.twig")
     */
    public function ListImage()
    {
        $images = $this->_galleryRepostory->GetImage();
        return array(
            'images' => $images
        );
    }
}