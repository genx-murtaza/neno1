<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

class CustomerMaster extends Component
{
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
