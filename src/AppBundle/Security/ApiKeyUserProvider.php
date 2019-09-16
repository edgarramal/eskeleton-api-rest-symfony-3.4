<?php

namespace App\AppBundle\Security;

use App\Repository\UserRepository;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * ApiKeyUserProvider constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $apiKey
     * @return string
     */
    public function getUsernameForApiKey($apiKey)
    {
        /** @var \App\Entity\User $user */
        $user = $this->userRepository->findOneBy(['token' => $apiKey]);
        if (is_null($user)) {
            throw new Exception("Incorrect token");
        }
        return $user->getUsername();
    }

    /**
     * @param string $username
     * @return \App\Entity\User|UserInterface
     */
    public function loadUserByUsername($username)
    {
        $user = new \App\Entity\User();
        $user->setUsername($username);
        return $user;
    }

    /**
     * @param UserInterface $user
     * @return UserInterface|void
     */
    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        throw new UnsupportedUserException();
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}