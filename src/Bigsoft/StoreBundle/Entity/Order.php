<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 07.01.14
 * Time: 0:14
 */

namespace Bigsoft\StoreBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Order {

    const PAY_TYPE_CHECK = 'check';
    const PAY_TYPE_CREDIT_CARD = 'credit_card';
    const PAY_TYPE_PURCHASE_ORDER = 'purchase_order';

    private $id;
    private $email;
    private $payType;
    private $name;
    private $address;
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $payType
     */
    public function setPayType($payType)
    {
        $this->payType = $payType;
    }

    /**
     * @return mixed
     */
    public function getPayType()
    {
        return $this->payType;
    }

    public function addCartItems($cartItems)
    {
        foreach ($cartItems as $cartItem) {
            $cartItem->setOrder($this);
            $this->items->add($cartItem);
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->calculateTotalPrice();
        }

        return $totalPrice;
    }


} 