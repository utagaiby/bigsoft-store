<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 07.01.14
 * Time: 0:19
 */

namespace Bigsoft\StoreBundle\Form\Type;


use Bigsoft\StoreBundle\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('address', 'textarea')
            ->add(
                'payType',
                'choice',
                [
                    'choices' => [
                        Order::PAY_TYPE_CHECK => 'Check',
                        Order::PAY_TYPE_CREDIT_CARD => 'Credit Card',
                        Order::PAY_TYPE_PURCHASE_ORDER => 'Purchase Order'
                    ]
                ]
            )
            ->add('email', 'email')
            ->add('Place Order', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'order';
    }
} 