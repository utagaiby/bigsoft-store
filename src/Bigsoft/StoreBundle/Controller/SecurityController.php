<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 07.01.14
 * Time: 21:44
 */

namespace Bigsoft\StoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'BigsoftStoreBundle:security:login.html.twig',
            ['last_username' => $session->get(SecurityContext::LAST_USERNAME), 'error' => $error]
        );
    }
} 