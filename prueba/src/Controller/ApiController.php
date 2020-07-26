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
}