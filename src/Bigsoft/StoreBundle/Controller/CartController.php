<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 18.12.13
 * Time: 9:19
 */

namespace Bigsoft\StoreBundle\Controller;


use Bigsoft\StoreBundle\Entity\Order;
use Bigsoft\StoreBundle\Form\Type\OrderType;
use Bigsoft\StoreBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function addAction(Request $request)
    {
        if (!$product = $this->getDoctrine()->getManager()->find('BigsoftStoreBundle:Product', $request->get('id'))) {
            throw $this->createNotFoundException();
        }

        $this->get('bigsoft.cart')->addProductToCart($product);

        return $this->redirect($this->generateUrl('product_view', ['id' => $product->getId()]));
    }

    public function clearAction()
    {
        $this->get('bigsoft.cart')->clearCurrentCart();
        return $this->redirect($this->generateUrl('cart_show'));
    }

    public function showItemsAction()
    {
        $cart = $this->get('bigsoft.cart')->getCurrentCart();
        return $this->render('BigsoftStoreBundle:cart:showItems.html.twig', ['cart' => $cart]);
    }

    public function checkoutAction(Request $request)
    {
        $cart = $this->get('bigsoft.cart')->getCurrentCart();
        if($cart->isEmpty()) {
            $this->get('session')->getFlashBag()->add('error', 'Your cart is empty');
            return $this->redirect($this->generateUrl('products_list'));
        }

        $order = new Order();
        $form = $this->createForm(new OrderType(), $order);

        if ('POST' == $request->getMethod()) {
            $form->submit($request);
            if ($form->isValid()) {
                $this->get('bigsoft.cart')->moveCartItemsToOrder($order);
                $this->get('bigsoft.mailing')->sendOrderCreatedMessage($order);
                $this->getDoctrine()->getManager()->persist($order);
                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->add('success', 'Your order was successfully created');
                return $this->redirect($this->generateUrl('products_list'));
            }
        }

        return $this->render('BigsoftStoreBundle:cart:checkout.html.twig', ['form' => $form->createView()]);
    }

} 