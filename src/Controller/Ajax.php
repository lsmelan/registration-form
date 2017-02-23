<?php

namespace Controller;

use Model\GenericEntity;
use Model\RepositoryFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Ajax
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function isRegisteredEmail()
    {
        $repository = (new RepositoryFactory())->getInstance('Registrations');
        $result = $repository->findByEmail($this->request->get('email'));

        $output = true;

        if ($result instanceof GenericEntity) {
            $output = false;
        }

        return new JsonResponse($output);
    }
}
