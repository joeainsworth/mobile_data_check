<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\ContactList as ContactList;

class ResultController extends Controller
{
	protected $view;

	public function index($request, $response)
	{
		$contactLists = ContactList::orderBy('created_at', 'desc')->get();

		if (!$contactLists->first()) {
			$this->flash->addMessage('error', 'There are no results to display, try uploading a file first.');
			return $response->withRedirect($this->router->pathFor('home'));
		}

		$data = array('contactLists' => $contactLists);
		return $this->container->view->render($response, 'results.twig', $data);
	}

	public function getResults($request, $response, $args)
	{
		$contactList = ContactList::where('id', $args['id'])->first();
		$subscribers = $contactList->subscribers()->orderBy('status', 'asc')->get();
		$data = array('subscribers' => $subscribers);

		return $this->container->view->render($response, 'subscribers/subscribers.twig', $data);
	}

	public function getDownload($request, $response, $args)
	{
		return $this->contactlist->createFile($args['id']);
	}
}