<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\Subscriber as Subscriber;

class SubscriberController extends Controller
{
	protected $view;

	public function index($request, $response)
	{
		return $this->container->view->render($response, 'subscriber.twig');
	}

	public function getSubscriber($request, $response, $args)
	{
		$subscriber = Subscriber::where('id', $args['id'])->first();
	}

	public function postSubscriber($request, $response)
	{
		$parsedBody = $request->getParsedBody();

		$subscriber = Subscriber::where('response_id', $parsedBody['id'])->first();

		$subscriber->status = $parsedBody['status'];
		$subscriber->networkCode = $parsedBody['networkCode'];
		$subscriber->errorCode = $parsedBody['errorCode'];
		$subscriber->errorDescription = $parsedBody['errorDescription'];
		$subscriber->location = $parsedBody['location'];
		$subscriber->countryName = $parsedBody['countryName'];
		$subscriber->countryCode = $parsedBody['countryCode'];
		$subscriber->network = $parsedBody['network'];
		$subscriber->ported = $parsedBody['ported'];
		$subscriber->portedFrom = $parsedBody['portedFrom'];

		if (!$subscriber->save()) {
			throw new \Exception("Subscriber update was not successful.");
		}
	}
}