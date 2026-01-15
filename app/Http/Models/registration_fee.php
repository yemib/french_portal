<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class registration_fee extends Model
{
    //
	
	public function  __construct(){
		
		if( !Schema::hasTable('registration_fees')  )	  { 
			
		       Schema::create('registration_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
		$table->double('fee')->nullable(); 
		
				   
            $table->timestamps();
        });
			
			
			
			
					}
		
	}
	
}
