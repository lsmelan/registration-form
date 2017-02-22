<?php

namespace Controllers;

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
        if ($this->request->getMethod() == 'POST') {

        }

        $html = $this->renderer->render('homepage', [
           'hello' => 'Hello World!'
        ]);

        return new Response($html);
    }
}
