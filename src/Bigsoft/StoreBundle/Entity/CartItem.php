<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 18.12.13
 * Time: 8:50
 */

namespace Bigsoft\StoreBundle\Entity;


class CartItem
{
    private $id;

    /** @var  Cart */
    private $cart;

    /** @var  Product */
    private $product;

    /**
     * @param \Bigsoft\StoreBundle\Entity\Cart $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return \Bigsoft\StoreBundle\Entity\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Bigsoft\StoreBundle\Entity\Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return \Bigsoft\StoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }


} 