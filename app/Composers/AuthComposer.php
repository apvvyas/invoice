<?php
namespace App\Composers;

use Illuminate\View\View;

class AuthComposer
{

	/**
     * Create a  composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = [
                'no_check_complete_alert' => true
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