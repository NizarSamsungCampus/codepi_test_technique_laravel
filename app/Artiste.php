<?php

namespace Concerto;

use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{
		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'artistes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom', 'description', 'image', 'tags'];
	/**
	 * The attributes excluded from the model's JSON form.
	 */
	public $timestamps = false;	
}
