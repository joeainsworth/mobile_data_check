<?php

namespace App\Upload;

use League\Csv\Reader;
use App\Models\Subscriber;
use libphonenumber\PhoneNumberUtil as PhoneNumber;
use libphonenumber\PhoneNumberFormat as PhoneNumberFormat;

class Upload
{
	public function parseFile($fileId, $fileName)
	{
		$csv = Reader::createFromPath('../public/uploads/'.$fileName);
		$rows = $csv->fetchAll();

		$subscribers = array();
		$phoneUtil = PhoneNumber::getInstance();

		foreach ($rows as $row) {
			$number = $phoneUtil->parse($row[0], "GB");
			$subscribers[] = array(
				'upload_id' => $fileId,
				'msisdn' => $phoneUtil->format($number, PhoneNumberFormat::E164),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			);
		}

		if(!Subscriber::insert($subscribers)) {
			throw new \Exception('There was a problem saving subscribers to the database.');
		}	

		return $subscribers;
	}
}