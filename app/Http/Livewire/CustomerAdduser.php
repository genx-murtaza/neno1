<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;

class CustomerAdduser extends Component
{
    // public $cid;
    // public $cname;
    // public $ccontact;
    // public $cemail;
    // public $cdob;
    // public $ctreatment;
    // public $ctotalamt;
    // public $ctotaldisc;
    // public $creference;

     // public $clientdata = [];

    // protected $rules = [

    //     'cname' => 'required|min:5|max:50',
    //     'cemail' => 'required|email',
    //     'ccontact' => 'required|min:10|max:21',
    // ];

    public function savecustomer()
    {
        // $data = $this->validate();
        // Session()->flash('fail','All Okay');
        // dd('$cname');
    }

    public function render()
    {
        return view('livewire.customer-adduser');
    }
}
