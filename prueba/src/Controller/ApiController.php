<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Swagger\Annotations as SWG;

class ApiController extends FOSRestController
{

    /**
     * List all users
     * @SWG\Parameter(
     *     in="query",
     *     type="number",
     *     minimum="0",
     *     name="offset",
     *     description="Offset from which to start listing users.",
     *     default="0"
     * )
     * @SWG\Parameter(
     *     in="query",
     *     type="integer",
     *     name="limit",
     *     description="How many users to return.",
     *     default="10"
     * )
     * @SWG\Response(
     *     response="200",
     *     description="Success",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=User::class)
     *     )
     * )
     * @SWG\Response(
     *     response="401",
     *     description="Unauthorized"
     * )
     * @Rest\Get("/api/users")
     *
     * @SWG\Tag(name="All Users")
     * @param Request $request
     * @return View
     */
    public function getAllUsersAction(Request $request)
    {
        $offset = $request->query->get('offset', 0);
        $limit = $request->query->get('limit', 10);

        /* @var UserRepository $userRepository */
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->getAllUsers($offset, $limit);

        return $this->view($users);
    }

    /**
     * User by ID
     * @Rest\Get("/api/user/info/{id}.{_format}", name="user", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets user info based on passed ID parameter.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=User::class)
     *     )
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="The user with the passed ID parameter was not found or doesn't exist."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="Internal error."
     * )     
     *  
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The user ID"
     * )
     *
     *
     * @SWG\Tag(name="User")
     */
    public function getUserAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $user = [];
        $message = "";

        try {
            $code = 200;
            $error = false;
            $user = $em->getRepository("App:User")->find($id);

            if (is_null($user)) {
                $code = 500;
                $error = true;
                $message = "The user does not exist";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get the current User - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $user : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }


/**
     * @Rest\Post("/api/user/info/{id}.{_format}", name="user_edit", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="The user was edited successfully.",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=User::class)
     *     )          
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="Internal error. An error has occurred trying to edit the user."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The user ID"
     * )
     *
     *
     * @SWG\Tag(name="User edit")
     */
    public function editUserAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $user = [];
        $message = "";

        try {
            $code = 200;
            $error = false;
            $username = $request->request->get("username", null);
            $email = $request->request->get("email", null);
            $enabled = $request->request->get("enabled", null);
            $password = $request->request->get("password", null);
            $roles = $request->request->get("roles", null);


            $user = $em->getRepository("App:User")->find($id);

            if (!is_null($user)) {
                $user->setUsername($username);
                $user->setUsernameCanonical($username);
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setEnabled($enabled);
                $user->setRoles((array)$roles);

                $em->persist($user);
                $em->flush();

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to edit user - User not found.";
            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to edit user - Error: {$ex->getMessage()}";
        }

        $response = [
            'code'  => $code,
            'error' => $error,
            'data'  => $code == 200 ? $user : $message,
        ];

        return new Response($serializer->serialize($response, "json"));
    }
   
}