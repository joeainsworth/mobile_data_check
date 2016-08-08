<?php

namespace App\ContactList;

use League\Csv\Reader;
use League\Csv\Writer;
use App\Models\Subscriber;
use App\Models\ContactList;
use libphonenumber\PhoneNumberUtil as PhoneNumber;
use libphonenumber\PhoneNumberFormat as PhoneNumberFormat;

class ContactList
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
				'contact_list_id' => $fileId,
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

	public function createFile($contactListId) 
	{
		$fields = array(
			'msisdn', 
			'status', 
			'networkCode', 
			'errorCode', 
			'errorDescription',
			'location',
			'countryName',
			'countryCode',
			'network',
			'networkType',
			'ported',
			'portedFrom',
			'created_at'
		);

		$contactList = ContactList::where('id', $contactListId)->first();
		$subscribers = $contactList->subscribers()
						->select($fields)
						->orderBy('status', 'asc')
						->get();

		$csv = Writer::createFromFileObject(new \SplTempFileObject());
		$csv->insertOne($fields);

		foreach ($subscribers as $subscriber) {
            $csv->insertOne($subscriber->toArray());
        }

		if(!$csv->output(uniqid($contactListId).'.csv')) {
			throw new \Exception('There was a problem exporting the requested file.');
		}
	}
}