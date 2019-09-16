<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;


class AuthorizationController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns token for Authorization",
     * )
     * @SWG\Parameter(
     *     name="username",
     *     in="query",
     *     type="string",
     *     description="Username"
     * )
     * @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     type="string",
     *     description="Password"
     * )
     * @SWG\Tag(name="Access")
     * @Security(name="api_key")
     */
    public function login(Request $request){
        $username = $request->get("username");
        $password = $request->get("password");

        /** @var User $user */
        $user = $this->userRepository->findOneBy(["username" => $username, "password" => $password]);

        if(!empty($user)){
            $token = bin2hex(random_bytes(78));
            $user->setToken($token);
            $this->userRepository->update($user);
            return new Response($token, Response::HTTP_OK);
        }else{
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }

    }
}