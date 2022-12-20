<?php

namespace App\Http\Livewire\Admin;

use App\Models\License;
use Livewire\Component;
use App\Helpers\Ilsyaa;
use App\Models\Product;

class AddLicense extends Component
{
    public $license, $slug, $type = 'product', $itemsssid;
    protected $rules = [
        'license' => 'required|unique:licenses',
        'slug' => 'required|unique:licenses',
        'type' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.add-license', [
            'products' => Product::where('product_type', 'pay')->get(),
        ]);
    }

    public function generate_license()
    {
        $this->license = Ilsyaa::license_unique();
    }

    public function generate_slug()
    {
        $this->slug = Ilsyaa::slug_unique();
    }

    // store
    public function store()
    {
        $this->validate();
        License::create([
            'license' => $this->license,
            'slug' => $this->slug,
            'type' => $this->type,
            'item_id' => $this->itemsssid,
            'used' => 'no',
        ]);
        $this->reset();
        $this->emit('alert', ['type' => 'success', 'message' => 'License Added Successfully']);
    }
}
