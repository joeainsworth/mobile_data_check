<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\Upload as Upload;

class HomeController extends Controller
{
	protected $view;

	public function index($request, $response)
	{
		return $this->container->view->render($response, 'home.twig');
	}
}