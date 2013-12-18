<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 18.12.13
 * Time: 9:19
 */

namespace Bigsoft\StoreBundle\Controller;


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

    public function showItemsAction()
    {
        $cart = $this->get('bigsoft.cart')->getCurrentCart();
        return $this->render('BigsoftStoreBundle:cart:showItems.html.twig', ['items' => $cart->getItems()->toArray()]);
    }

} 