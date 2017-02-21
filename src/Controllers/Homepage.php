<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Homepage
{
    public function showForm(Request $request)
    {
        if ($request->getMethod() == 'POST') {

        }

        return new Response("It is working");
    }
}
