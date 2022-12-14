<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

class CustomerMaster extends Component
{
    public $cid;
    public $cname;
    public $ccontact;
    public $cemail;
    public $cdob;
    public $ctreatment;
    public $ctotalamt;
    public $ctotaldisc;
    public $creference;

    public $allcustomers = [];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->allcustomers = Customer::all();
        // dd($allcustomers);
        return view('livewire.customer-master');
    }
}
