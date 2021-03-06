<?php

namespace Controller;

use Model\RegistrationEntity;
use Model\RepositoryFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use View\Renderer;

class Homepage
{
    private $request;
    private $renderer;

    public function __construct(Request $request, Renderer $renderer)
    {
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function showForm()
    {
        $message = "";
        $errorCount = 0;

        if ($this->request->getMethod() == 'POST') {
            $message = "Registo realizado com sucesso!";

            $data = $this->request->request->all();
            $entity = new RegistrationEntity($data);
            $repository = (new RepositoryFactory())->getInstance('Registrations');
            $errors = $repository->save($entity);

            if (!empty($errors)) {
                $message = "Registo não realizado, tente novamente mais tarde";
                $errorCount = count($errors);
            }
        }

        $html = $this->renderer->render('form',
            [
                'message' => $message,
                'errorCount' => $errorCount
            ]
        );

        return new Response($html);
    }
}
