<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model {

protected $fillable =  ['post_title',  
							'role', 
							'city', 
							'experience',  
							'time_for', 
							'unique_id'
						   ];

}