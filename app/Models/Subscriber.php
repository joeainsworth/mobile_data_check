<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	// Name of the uploads table
	protected $table = 'subscriber';

	// Columns to write too
	protected $fillable = [ 
		'contact_list_id',
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
		'portedFrom'
	];

	// One-to-one relationship
	// Each subscriber belongs to one original CSV upload
	public function upload()
    {
        return $this->hasOne('App\Models\ContactList');
    }
}