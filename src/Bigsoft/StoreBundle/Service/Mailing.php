<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 07.01.14
 * Time: 16:18
 */

namespace Bigsoft\StoreBundle\Service;


use Bigsoft\StoreBundle\Entity\Order;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Mailing {

    /** @var  Swift_Mailer */
    private $mailer;

    /** @var  EngineInterface */
    private $templating;

    private $fromAddress;

    public function __construct(Swift_Mailer $mailer, EngineInterface $templating, $fromAddress)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->fromAddress = $fromAddress;
    }

    public function sendOrderCreatedMessage(Order $order)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Order in Bigsoft Store was successfully create')
            ->setFrom($this->fromAddress)
            ->setTo($order->getEmail())
            ->setBody(
                $this->templating->render('BigsoftStoreBundle:mailing:newOrder.html.twig', ['order' => $order]),
                'text/html'
            )
            ->addPart(
                $this->templating->render('BigsoftStoreBundle:mailing:newOrder.txt.twig', ['order' => $order]),
                'text/plain'
            );


        $attachment = \Swift_Attachment::newInstance(
            $this->templating->render('BigsoftStoreBundle:mailing:invoice.txt.twig', ['order' => $order]),
            'invoice.pdf',
            'application/pdf'
        );

        $message->attach($attachment);

        $this->mailer->send($message);
    }
} 