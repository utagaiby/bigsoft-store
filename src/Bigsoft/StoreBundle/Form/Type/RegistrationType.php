<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 12.01.14
 * Time: 15:51
 */

namespace Bigsoft\StoreBundle\Form\Type;


use Bigsoft\StoreBundle\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("firstName", "text")
            ->add("lastName", "text")
            ->add("email", "email")
            ->add('password', 'repeated', [
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add("address", "textarea")
            ->add("payType", "choice", [
                'choices' => [
                    Order::PAY_TYPE_CHECK => 'Check',
                    Order::PAY_TYPE_CREDIT_CARD => 'Credit Card',
                    Order::PAY_TYPE_PURCHASE_ORDER => 'Purchase Order'
                ]
            ])
            ->add("Register", "submit");
    }
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "registration";
    }
}