<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
	// Name of the uploads table
	protected $table = 'contact_list';

	// Columns to write too
	protected $fillable = [ 'fileName' ];

	// One-to-many relationship
	public function subscribers()
    {
        return $this->hasMany('App\Models\Subscriber');
    }
}