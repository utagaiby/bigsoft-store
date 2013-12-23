<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 18.12.13
 * Time: 8:48
 */

namespace Bigsoft\StoreBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Cart
{
    private $id;
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
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
     * @param mixed $items
     */
    public function setItems(ArrayCollection $items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    public function addItem(CartItem $item)
    {
        $this->items->add($item);
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->calculateTotalPrice();
        }

        return $totalPrice;
    }

    public function findCartItemForProduct(Product $product)
    {
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() == $product->getId()) {
                return $item;
            }
        }

        return null;
    }
} 