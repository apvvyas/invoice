<?php

namespace App\Composers;

use Auth;
use Illuminate\View\View;

class GlobalComposer
{

    public $data = [];
	/**
     * Create a  composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = [

                'user' => Auth::user(),
                'company_logo'  => Auth::user()->getFirstOrDefaultMediaUrl('company-logo')
        ];
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with($this->data);
    }
}