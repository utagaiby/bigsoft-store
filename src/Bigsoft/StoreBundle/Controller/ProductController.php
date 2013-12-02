<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 02.12.13
 * Time: 18:47
 */

namespace Bigsoft\StoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function listAction() {
        $products = $this->getDoctrine()->getRepository('BigsoftStoreBundle:Product')->findAll();
        return $this->render('BigsoftStoreBundle:product:list.html.twig', ['products' => $products]);
    }
}