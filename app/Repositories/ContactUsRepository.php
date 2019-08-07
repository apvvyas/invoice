<?php

namespace App\Repositories;

use App\Models\ContactUs;

class ContactUsRepository
{
	function create($data){
			return ContactUs::create($data);
    }
    
    function update($data,ContactUs $contact){
			$contact->update($data);
			return $contact;
	}
}
