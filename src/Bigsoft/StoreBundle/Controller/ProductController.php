<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 02.12.13
 * Time: 18:47
 */

namespace Bigsoft\StoreBundle\Controller;


use Bigsoft\StoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function listAction()
    {
        $products = $this->getDoctrine()->getRepository('BigsoftStoreBundle:Product')->findAll();
        return $this->render('BigsoftStoreBundle:product:list.html.twig', ['products' => $products]);
    }

    public function createAction()
    {
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('price', 'text')
            ->add('imageUrl', 'text')
            ->add('Save', 'submit')->getForm();

        if ('POST' == $this->getRequest()->getMethod()) {
            $form->submit($this->getRequest());
            $submittedProduct = $form->getData();
            $this->getDoctrine()->getManager()->persist($submittedProduct);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($this->generateUrl('products_list'));
        }

        return $this->render('BigsoftStoreBundle:product:create.html.twig', ['form' => $form->createView()]);


    }
}