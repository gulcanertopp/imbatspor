<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(service="app.default_controller")
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     * @Template("AppBundle:Default:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return array();
    }


    /**
     * @Route("/about", name="app_about")
     * @Template("AppBundle:Default:about.html.twig")
     */
    public function About(Request $request)
    {
        return array();
    }

    /**
     * @Route("/contact", name="app_contact")
     * @Template("AppBundle:Default:contact.html.twig")
     */
    public function Contact(Request $request)
    {
        return array();
    }


    /**
     * @Route("/desing-form", name="app_design_form")
     * @Template("AppBundle:Default:design-form.html.twig")
     */
    public function DesignForm(Request $request)
    {
        return array();
    }
}
