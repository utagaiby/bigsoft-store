<?php
/**
 * Created by PhpStorm.
 * User: utagai
 * Date: 02.12.13
 * Time: 16:39
 */

namespace Bigsoft\StoreBundle\Controller;


use Bigsoft\StoreBundle\Entity\User;
use Bigsoft\StoreBundle\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class IndexController extends Controller
{

    public function indexAction()
    {
        return $this->render('BigsoftStoreBundle:index:index.html.twig');
    }

    public function registerAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createNotFoundException();
        }

        $user = new User();

        $form = $this->createForm(new RegistrationType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $this->encodePasswordAndSaveUser($user);
                $this->authenticateUser($user);
                return $this->redirect($this->generateUrl("main"));
            }
        }

        return $this->render("BigsoftStoreBundle:index:register.html.twig", ['form' => $form->createView()]);
    }

    private function encodePasswordAndSaveUser(User $user)
    {
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();
    }

    private function authenticateUser(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->get('security.context')->setToken($token);
        $this->get('session')->set('_security_secured_area',serialize($token));
    }

} 