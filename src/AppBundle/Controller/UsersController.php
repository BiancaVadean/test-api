<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UsersAddType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsersController
 *
 * @author Bianca VADEAN bianca.vadean@zitec.com
 * @copyright Copyright (c) Zitec COM
 */
class UsersController extends FOSRestController
{
    public function createAction(Request $request)
    {
        $form = $this->createForm(UsersAddType::class, new User());
        $form->submit($request->request->all());
        if ($form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $view = $this->view('User id: ' . $user->getId())->setStatusCode(Response::HTTP_CREATED);
        } else {
            $view = $this->view(['form' => $form]);
        }
        return $view;
    }

    public function getUsersAction(Request $request)
    {
        $repository = $this->get('doctrine.orm.entity_manager')->getRepository(User::class);
        $users = $repository->findAll();
        $view = $this->view($users);

        return $view;
    }
}
