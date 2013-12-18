<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 18.12.13
 * Time: 9:08
 */

namespace Bigsoft\StoreBundle\Service;


use Bigsoft\StoreBundle\Entity\CartItem;
use Bigsoft\StoreBundle\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart
{
    /** @var  Registry */
    private $doctrine;

    /** @var  Session */
    private $session;

    public function __construct(Registry $doctrine, Session $session)
    {
        $this->doctrine = $doctrine;
        $this->session = $session;
    }

    public function getCurrentCart()
    {
        $storedCartId = $this->session->get('cart_id');
        $em = $this->doctrine->getManager();

        if ($storedCartId) {
            if ($cart = $em->getRepository('BigsoftStoreBundle:Cart')->find($storedCartId)) {
                return $cart;
            }
        }

        $newCart = new \Bigsoft\StoreBundle\Entity\Cart();
        $this->doctrine->getManager()->persist($newCart);
        $this->doctrine->getManager()->flush();

        $this->session->set('cart_id', $newCart->getId());

        return $newCart;
    }

    public function addProductToCart(Product $product)
    {
        $cartItem = new CartItem();
        $cartItem->setProduct($product);
        $currentCart = $this->getCurrentCart();
        $cartItem->setCart($currentCart);
        $currentCart->addItem($cartItem);

        $em = $this->doctrine->getManager();
        $em->persist($cartItem);
        $em->flush();
    }
} 