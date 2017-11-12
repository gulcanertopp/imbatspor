<?php

namespace AdminBundle\Controller;

use AdminBundle\Controller\BaseController;
use AppBundle\Data\Repository\UserRepository;
use AppBundle\Data\Utils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route(service="admin.default_controller")
 */
class DefaultController extends BaseController
{
    private $_userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;

    }
    /**
     * @Route("/",name="admin")
     * @Template("AdminBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        $user = $this->_userRepository->GetUser();
        //var_dump($user);exit;
        return array(
            'user'=> $user
        );
    }


    /**
     * @Route("/login", name="login")
     * @Template("AdminBundle:Default:login.html.twig")
     */
    public function LoginAction()
    {
        return  array ();
    }

    /**
     * @Route("/ajax/login", name="ajax_login")
     */
    public function AjaxLoginAction(Request $request)
    {
        $name = $request->request->get('username');
        $password = $request->request->get('password');

        $users = $this->_userRepository->LoginUser($name,$password);

        if ($users === false)
            return new JsonResponse(array(
                'success' => false
            ));


        $this->GetSession()->set('id',$users->ID);
        $this->GetSession()->set('name',$users->UserName);

        return new JsonResponse(array (
            'success' => true
        ));
    }
    /**
     * @Route("/ajax/logout", name="logout")
     */
    public function LogoutAction()
    {
        $this->GetSession()->clear();
        return $this->redirect('/admin');
    }




    /**
     * Media Easy Save Action
     * @Route("/media/save/easy/", name="admin_media_save_easy")
     */
    public function MediaEasySaveAction(Request $request)
    {
        $files = $request->files->get('file');
        $size  = floatval($request->get('s',-1));
        $urls = array();
        /** @var UploadedFile $file */

        foreach($files as &$file){
            $mime = explode("/",$file->getMimeType())[0];

            if($mime != "image"){
                return new JsonResponse(
                    array(
                        'success' => false
                    ));
            }

            if($size != -1 && ($file->getClientSize() / 31457280) > $size){
                return new JsonResponse(
                    array(
                        'success' => false,
                        'message' =>  'Resim Cok büyük'
                    ));
            }

            $fileUploadResult = Utils::Upload($file);
            if ($fileUploadResult['code'] !== 200) {
                return new JsonResponse(
                    array(
                        'success' => false

                    ));
            }

            $urls[] = $fileUploadResult['path'];
        }
        return new JsonResponse(
            array(
                'success' => count($urls) > 0,
                'urls'    => $urls
            ));
    }
    /**
     * Media Easy Save Action
     * @Route("/media/save/easy/pdf/", name="admin_media_save_easy_pdf")
     */
    public function MediaEasyPdfSaveAction(Request $request)
    {

        $files = $request->files->get('file');
        $size  = floatval($request->get('s',-1));
        $urls = array();
        /** @var UploadedFile $file */

        foreach($files as &$file){

            if($size != -1 && ($file->getClientSize() / 31457280) > $size){
                return new JsonResponse(
                    array(
                        'success' => false,
                        'message' =>  'Resim Cok büyük'
                    ));
            }

            $fileUploadResult = Utils::Upload($file);
            if ($fileUploadResult['code'] !== 200) {
                return new JsonResponse(
                    array(
                        'success' => false

                    ));
            }

            $urls[] = $fileUploadResult['path'];
        }
        return new JsonResponse(
            array(
                'success' => count($urls) > 0,
                'urls'    => $urls
            ));
    }
}
