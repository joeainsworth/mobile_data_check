<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class ResultsController extends Controller
{
	protected $view;

	public function index($request, $response)
	{
		return $this->container->view->render($response, 'results.twig');
	}
}