<?php

namespace App\Subscriber;

use App\Models\Subscriber as Subscriber;

class Subscriber
{
	public function parseSubscribers($uploadId)
	{
		$subscribers = Subscriber::where('upload_id', $uploadId)->get();

		foreach ($subscribers as $subscriber) {
			$response = $this->postSubscriber($subscriber);
			// Refactor into an array of ids & responses
			// Execute mass update query after loop ends
			$subscriber->response_id = $response->id;
			$subscriber->save();
		}
	}

	private function postSubscriber($subscriber)
	{

		$data = array(
			"username" => "a",
			"password" => "b",
			"msisdn" => (string)$subscriber->msisdn,
			"webhook" => 'http://981583bf.ngrok.io/firetext_challenge/public/subscriber'
		);
		
		$data_string = json_encode($data);

		$ch = curl_init('https://ms.4url.eu/lookup');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
		);

		$result = curl_exec($ch);
		
		return json_decode($result);
	}
}