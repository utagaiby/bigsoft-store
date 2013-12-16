<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 16.12.13
 * Time: 19:26
 */

namespace Bigsoft\StoreBundle\Twig;


class MoneyFormatExtension extends \Twig_Extension {

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function priceFilter($number, $decimals = 2, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function getName()
    {
        'bigsoft_money_format';
    }
}