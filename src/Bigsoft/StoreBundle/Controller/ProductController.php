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
use Bigsoft\StoreBundle\Form\Type\ProductType;

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
        $form = $this->createProductForm($product);

        if ('POST' == $this->getRequest()->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()){
                $this->getDoctrine()->getManager()->persist($product);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('products_list'));
            }
        }

        return $this->render('BigsoftStoreBundle:product:create.html.twig', ['form' => $form->createView()]);


    }

    private function createProductForm(Product $product)
    {
        return $this->createForm(new ProductType(), $product);
    }

    public function editAction($id)
    {
        $product = $this->getDoctrine()->getManager()->getRepository('BigsoftStoreBundle:Product')->find($id);
        if (null == $product) {
            throw $this->createNotFoundException();
        }

        $form = $this->createProductForm($product);

        if ('POST' == $this->getRequest()->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect($this->generateUrl('products_list'));
            }
        }

        return $this->render('BigsoftStoreBundle:product:edit.html.twig', ['form' => $form->createView()]);

    }

    public function viewAction($id)
    {
        $product =  $this->getDoctrine()->getManager()->getRepository('BigsoftStoreBundle:Product')->find($id);

        if (null == $product) {
            throw $this->createNotFoundException();
        }

        return $this->render('BigsoftStoreBundle:product:view.html.twig', ['product' => $product]);
    }

    public function deleteAction($id)
    {
        $product =  $this->getDoctrine()->getManager()->getRepository('BigsoftStoreBundle:Product')->find($id);

        if (null == $product) {
            throw $this->createNotFoundException();
        }

        $cartItems = $this->getDoctrine()->getRepository('BigsoftStoreBundle:CartItem')->findBy(['product' => $product]);

        if ($cartItems) {
            $this->get('session')->getFlashBag()->add('error', 'There are cart items for product ' . $product->getTitle());
        } else {
            $this->getDoctrine()->getManager()->remove($product);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirect($this->generateUrl('products_list'));

    }
}