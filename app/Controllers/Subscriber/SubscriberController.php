<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\Subscriber as Subscriber;

class SubscriberController extends Controller
{
	protected $view;

	public function getSubscriber($request, $response, $args)
	{
		if($subscriber = Subscriber::where('id', $args['id'])->first()) {
			$data = array('subscriber' => $subscriber);
			return $this->container->view->render($response, 'subscribers/subscriber.twig', $data);
		} else {
			$this->flash->addMessage('error', 'There was an error retrieving the subscribers information.');
			return $response->withRedirect($this->router->pathFor('home'));
		}
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
		$subscriber->networkType = $parsedBody['networkType'];
		$subscriber->ported = $parsedBody['ported'];
		$subscriber->portedFrom = $parsedBody['portedFrom'];

		if (!$subscriber->save()) {
			throw new \Exception("Subscriber update was not successful.");
		}
	}
}