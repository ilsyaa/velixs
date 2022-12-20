<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;

class ProductCategory extends Component
{
    use WithPagination;
    public $categories, $perpage, $search, $sort, $price, $tags = [], $tag, $auth_user;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['as' => 's'],
        'sort',
        'price' => ['as' => 'price'],
        'tag' => ['as' => 'tags'],
        'categories' => ['as' => 'c']
    ];

    public function mount()
    {
        $this->sort = request()->query('sort', $this->sort);
        $this->search = request()->query('s', $this->search);
        $this->price = request()->query('price', $this->price);
        $this->tag = request()->query('tags', $this->tag);
        $this->categories = request()->query('category', $this->categories);
    }

    public function render()
    {
        if ($this->tags) {
            $this->tag = implode(',', $this->tags);
        } else {
            if (request()->query('tags') == null) {
                $this->tag = null;
            } else {
                $this->tags = explode(",", request()->query('tags'));
            }
        }

        if ($this->price == 'all') {
            $this->price = null;
        }

        if ($this->categories == 'all') {
            $this->categories = null;
        }

        $categories = $this->categories;
        $sort = $this->sort;

        $product = Product::where('status', '!=', 'draft')->where('name', 'LIKE', '%' . $this->search . '%');
        if ($categories) {
            $product->whereHas('category', function ($query) use ($categories) {
                $query->where('slug', $categories);
            });
        }

        if ($this->price == 'pay') {
            $product->where('product_type', '=', 'pay');
        } else if ($this->price == 'free') {
            $product->where('product_type', '=', 'free');
        }

        if ($this->tags) {
            $product->whereHas('tags', function ($query) {
                $query->whereIn('slug', $this->tags);
            });
        }

        if ($sort == 'top-selling') {
            $product->withCount('library as count_sales')->orderBy('count_sales', 'desc');
        } else if ($sort == 'low-price') {
            $product->orderBy('price_usd', 'asc');
        } else if ($sort == 'high-price') {
            $product->orderBy('price_usd', 'desc');
        } else if ($sort == 'a-z') {
            $product->orderBy('name', 'asc');
        } else if ($sort == 'z-a') {
            $product->orderBy('name', 'desc');
        } else {
            $product->latest();
        }
        $this->emit('refresh_render');
        $product = $product->paginate($this->perpage);

        return view('livewire.product-category', [
            'products' => $product,
            'tags_list' => Tag::where('type', 'product')->get(),
            'categories_list' => Category::where('type', 'product')->get(),
        ]);
    }

    public function resetall()
    {
        $this->search = null;
        $this->sort = null;
        $this->tags = [];
        $this->tag = null;
        $this->categories = null;
        $this->price = null;
        $this->resetPage();
    }

    public function changeall()
    {
        $this->categories = null;
        $this->resetPage();
    }

    public function cate($val)
    {
        $this->categories = $val;
        $this->resetPage();
    }

    public function updatingCategories()
    {
        $this->resetPage();
    }

    public function updatingTags()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPrice()
    {
        $this->resetPage();
    }

    public function previousPage($pageName = 'page')
    {
        $this->emit('refresh_pagination');
        $this->setPage(max($this->paginators[$pageName] - 1, 1), $pageName);
    }

    public function nextPage($pageName = 'page')
    {
        $this->emit('refresh_pagination');
        $this->setPage($this->paginators[$pageName] + 1, $pageName);
    }
}
