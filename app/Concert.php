<?php

namespace Concerto;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'concerts';

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
