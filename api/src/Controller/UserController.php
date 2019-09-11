<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends Controller
{
    private $userRepository;
    private $serializer;
    public function __construct(UserRepository $userRepository, SerializerInterface $serializer)
    {
        $this->userRepository = $userRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function findAll(){
        return new Response(
            $this->serializer->serialize($this->userRepository->findAll(), "json"),
            Response::HTTP_OK,
            ["content-type" => "json/application"]
        );
    }

    /**
     * @Route("/user/{id}", methods={"GET"})
     * @param string $id
     * @return Response
     */
    public function find(string $id){
        return new Response(
            $this->serializer->serialize($this->userRepository->find($id), "json"),
            Response::HTTP_OK,
            ["content-type" => "json/application"]
        );
    }
}
