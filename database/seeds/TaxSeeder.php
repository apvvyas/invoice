<?php

use App\Models\Tax;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Taxes = [
        	[
        		'name'=> 'GST 1',
        		'rate'=>'5'
        	],
        	[
        		'name'=> 'GST 2',
        		'rate'=>'12'
        	],
        	[
        		'name'=> 'GST 3',
        		'rate'=>'18'
        	],
        	[
        		'name'=> 'GST 4',
        		'rate'=>'28'
        	]
        ];

        foreach($Taxes as $tax){
        	Tax::create($tax);
        }
    }
}
