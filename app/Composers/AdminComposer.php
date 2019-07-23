<?php

namespace App\Composers;

use Auth;
use Illuminate\View\View;

class AdminComposer
{

    public $data = [];
	/**
     * Create a  composer.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::check()){
            $user = Auth::user();
            $this->data = [

                    'user' => $user,
                    'company_logo'  => (!empty($user))?$user->getFirstOrDefaultMediaUrl('company-logo'):'',
                    'complete_profile' => $user->hasCompleteProfile()
            ];    
        }
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if(Auth::check())
            $view->with($this->data);
    }
}