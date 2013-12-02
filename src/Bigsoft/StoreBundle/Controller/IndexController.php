<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 02.12.13
 * Time: 16:39
 */

namespace Bigsoft\StoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{

    public function indexAction()
    {
        return $this->render('BigsoftStoreBundle:index:index.html.twig');
    }

} 