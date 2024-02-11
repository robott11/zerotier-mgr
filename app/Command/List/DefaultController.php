<?php

namespace App\Command\List;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        $this->display('Hello World!');
    }
}
