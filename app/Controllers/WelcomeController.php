<?php

namespace App\Controllers;

use Jnana\Routes\Get;

final class WelcomeController extends BaseController
{
    #[Get('/')]
    public function index()
    {
        return $this->render('welcome');
    }
}
