<?php

namespace App\Repositories;

use App\Models\Tax;

class TaxRepository
{
    function create($data){
			return Tax::create($data);
    }
    
    function update($data,$tax){
			$tax->update($data);
			return $tax;
	}
}
