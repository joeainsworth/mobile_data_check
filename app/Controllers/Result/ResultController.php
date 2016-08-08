<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\Upload as Upload;

class ResultController extends Controller
{
	protected $view;

	public function index($request, $response)
	{
		$uploads = Upload::orderBy('created_at', 'desc')->get();

		if (!$uploads->first()) {
			$this->flash->addMessage('error', 'There are no results to display, try uploading a file first.');
			return $response->withRedirect($this->router->pathFor('home'));
		}

		$data = array('uploads' => $uploads);
		return $this->container->view->render($response, 'results.twig', $data);
	}

	public function getResults($request, $response, $args)
	{
		$upload = Upload::where('id', $args['id'])->first();
		$subscribers = $upload->subscribers()->orderBy('status', 'asc')->get();
		$data = array('subscribers' => $subscribers);

		return $this->container->view->render($response, 'subscribers/subscribers.twig', $data);
	}

	public function downloadResults($request, $response, $args)
	{
		
	}
}