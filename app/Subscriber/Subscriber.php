<?php

namespace App\Subscriber;

use App\Models\Subscriber as Subscriber;

class Subscriber
{
	public function parseSubscribers($uploadId)
	{
		$subscribers = Subscriber::where('contact_list_id', $uploadId)->get();
		$i = 0;

		foreach ($subscribers as $subscriber) {
			$response = $this->postSubscriber($subscriber);

			// Refactor into an array for mass update query outside of loop
			$subscriber->response_id = $response->id;
			$subscriber->save();

			// Limit requests to 50 per second
			$i ++;
			if ($i == 50) {
				sleep(1);
			}
		}
	}

	private function postSubscriber($subscriber)
	{

		$data = array(
			"username" => "a",
			"password" => "b",
			"msisdn" => (string)$subscriber->msisdn,
			"webhook" => 'http://981583bf.ngrok.io/firetext_challenge/public/subscriber/post'
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