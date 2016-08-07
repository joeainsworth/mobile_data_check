<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	// Name of the uploads table
	protected $table = 'subscriber';

	// Columns to write too
	protected $fillable = [ 
		'upload_id',
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
}