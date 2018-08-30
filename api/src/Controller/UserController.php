<?php
namespace App\Controller;

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
}
