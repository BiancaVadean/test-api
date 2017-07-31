<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UsersAddType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class UsersController
 *
 * @author Bianca VADEAN bianca.vadean@zitec.com
 * @copyright Copyright (c) Zitec COM
 */
class UsersController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  section = "Users",
     *  description="Create a new user",
     *  input= {
     *    "class" = "AppBundle\Form\Type\UsersAddType",
     *    "name" = "",
     *  },
     *  statusCodes = {
     *     201 = "Returned when entity was successfully created",
     *     400 = "Returned when invalid parameters",
     *   }
     * )
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
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

    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getUsersAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $repository->findAll();
        $view = $this->view($users);

        return $view;
    }

    /**
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function updateUsersAction(int $id)
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(User::class);
        $user = $repository->find($id);
        if (!$user) {
            throw new ResourceNotFoundException('Entity not found!');
        }
        $form = $this->createForm(UsersAddType::class, $user);
        $requestData = $request->request->all();
        unset($requestData['email']); // TODO Intended bug
        $form->submit($requestData, false);
        if ($form->isValid()) {
            $data = $form->getData();
            $em->merge($data);
            $em->flush();
            $view = $this->view();
        } else {
            $view = $this->view(array('form' => $form));
        }

        return $view;
    }

    /**
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function deleteUsersAction(int $id)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        if (!$user) {
            throw new ResourceNotFoundException('Entity not found!');
        }

        $doctrine->getManager()->remove($user);
        $doctrine->getManager()->flush();

        return $this->view();
    }

    public function getUserAction(int $id)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        if (!$user) {
            $view = $this->view('Entity not found!');
        } else {
            $view = $this->view($user);
        }

        return $view;
    }
}
