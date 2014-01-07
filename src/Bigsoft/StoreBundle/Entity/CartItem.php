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

    private $quantity;

    /** @var  Order */
    private $order;

    /**
     * @param \Bigsoft\StoreBundle\Entity\Cart $cart
     */
    public function setCart($cart)
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

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function calculateTotalPrice()
    {
        return $this->quantity * $this->getProduct()->getPrice();
    }

    /**
     * @param \Bigsoft\StoreBundle\Entity\Order $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return \Bigsoft\StoreBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }


}