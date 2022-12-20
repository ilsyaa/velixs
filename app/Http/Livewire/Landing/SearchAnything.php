<?php

namespace App\Http\Livewire\Landing;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class SearchAnything extends Component
{
    public $results, $search;

    public function render()
    {
        $this->render_result();
        return view('livewire.landing.search-anything');
    }

    public function clear()
    {
        $this->search = '';
        $this->results = '';
    }

    public function render_result()
    {
        if ($this->search) {
            $this->results = '';
            $prefix = config('app.prefix_license');
            if (preg_match("/$prefix-/i", $this->search)) {
                $this->results = '<div class="text-center my-5"><i style="font-size: 40px" class="bi bi-window"></i><h6>Looks like you typed in the prefix license.</h6><a href="' . route('front.license.index') . '" class="btn btn-dark btn-sm shadow">Claim License</a></div>';
            }
            $product = Product::where('name', 'like', '%' . $this->search . '%')->limit(5)->get();
            foreach ($product as $p) {
                $this->results .= '<div class="list-group list-search"><a href="' . route('front.product.detail', $p->slug) . '" class="list-group-search list-group-item-action"><span class="badge text-bg-secondary">Product</span> ' . $p->name . '</a></div>';
            }
            $blogs = Blog::where('title', 'like', '%' . $this->search . '%')->limit(5)->get();
            foreach ($blogs as $b) {
                $this->results .= '<div class="list-group list-search"><a href="' . route('front.' . $b->content_type . '.detail',  $b->slug) . '" class="list-group-search list-group-item-action"><span class="badge text-bg-secondary">' . \Str::ucfirst($b->content_type) . '</span> ' . $b->title . '</a></div>';
            }
            $user = User::where('name', 'like', '%' . $this->search . '%')->orWhere('username', 'like', '%' . $this->search . '%')->limit(10)->get();
            foreach ($user as $u) {
                $this->results .= '<div class="list-group list-search"><a href="' . route('front.profile.index', $u->username) . '" class="list-group-search list-group-item-action"><span class="badge text-bg-secondary">User</span> ' . $u->name . '</a></div>';
            }

            if ($this->results == '') {
                $this->results = '<div class="text-center my-5"><i style="font-size: 40px" class="bi bi-app-indicator"></i><h6>We couldn' . "'" . 't find what you were looking for.</h6></div>';
            }
        } else {
            $this->results = '';
        }
    }
}
