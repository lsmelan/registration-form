<?php

namespace View;

interface Renderer
{
    const FILES_PATH = "../../views";

    public function render($name, array $data);
}