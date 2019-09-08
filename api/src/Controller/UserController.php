<?php
namespace App\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    /**
     * @Route('/users')
     * @Method({'GET'})
     */
    public function findAll(){
        return new Response("Hello World!");
    }

    /**
     * @Route('/user/{id}')
     * @Method({'GET'})
     * @param string $id
     * @return Response
     */
    public function find(string $id){
        return new Response("User {$id}");
    }
}
