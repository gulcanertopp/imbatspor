<?php
/**
 * Created by PhpStorm.
 * User: AlperSalviz
 * Date: 16.4.2017
 * Time: 21:47
 */

namespace AppBundle\Domain\Helper;

use AppBundle\Data\Repository\BrandRepository;
use AppBundle\Data\Repository\CategoryRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class GenericHelper extends \Twig_Extension
{

    private $_container;
    private $_categoryRepository;
    private $_requestStack;
    private $_brandRepository;

    public function __construct(ContainerInterface $container, RequestStack $requestStack, CategoryRepository $categoryRepository,BrandRepository $brandRepository)
    {
        $this->_categoryRepository = $categoryRepository;
        $this->_container = $container;
        $this->_requestStack = $requestStack;
        $this->_brandRepository = $brandRepository;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getMenu', array($this, 'getMenu')),
            new \Twig_SimpleFunction('getBrand', array($this, 'getBrand')),
        );
    }

    public function getMenu(){

        $categories = $this->_categoryRepository->GetCategoryWithSub();

        return $categories;
    }


    public function getBrand(){

        $brands = $this->_brandRepository->GetBrand();

        return $brands;
    }



}