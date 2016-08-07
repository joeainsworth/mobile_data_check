<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
	// Name of the uploads table
	protected $table = 'uploads';

	// Columns to write too
	protected $fillable = [ 'fileName' ];
}