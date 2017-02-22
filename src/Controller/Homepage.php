<?php

namespace Controller;

use Model\BaseRepository;
use Model\RegistrationEntity;
use Model\RepositoryFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use View\Renderer;

class Homepage
{
    private $request;
    private $renderer;
    private $repository;

    public function __construct(Request $request, Renderer $renderer)
    {
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function showForm()
    {
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->request->all();
            $entity = new RegistrationEntity($data);
            $this->getRepository()->save($entity);
        }

        $html = $this->renderer->render('form');

        return new Response($html);
    }

    public function getRepository()
    {
        if (!$this->repository instanceof BaseRepository) {
            $this->repository = (new RepositoryFactory())->getInstance('Registrations');
        }

        return $this->repository;
    }
}
