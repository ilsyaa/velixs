<div>
    <section class="py-5">
        <div class="container">
            <div class="d-flex mb-3">
                <div class="me-auto">
                    <h6 class="text-muted fw-bold"><span class="title-gradient">Explore</span> Items</h6>
                </div>
                <small wire:loading.remove class="text-muted fades-load">Items <span class="text-success">{{ $products->count() }}</span></small>
                <small wire:loading class="text-muted fades-load">
                    <div style="height: 13px; width: 13px" class="spinner-grow" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> Loading
                </small>
            </div>
            <div class="card mb-3 border-0">
                <div class="card-body rounded pb-0">
                    <div class="row row-cols-1 row-cols-xl-3 d-flex">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="search-group-icon__ input-group-text text-muted"><i class="bi bi-search"></i></span>
                                <input wire:model="search" type="text" class="form-control search-group-input__" placeholder="Search Item">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="select-group-icon__ input-group-text text-muted"><i class="bi bi-wallet2"></i></span>
                                <select wire:model="price" class="form-select select-group-input__" aria-label="Default select example">
                                    <option value="all">All</option>
                                    <option value="pay">Pay</option>
                                    <option value="free">Free</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="select-group-icon__ input-group-text text-muted"><i class="bi bi-sort-alpha-up"></i></span>
                                <select wire:model="sort" class="form-select select-group-input__" aria-label="Default select example">
                                    <option value="latest">Latest</option>
                                    <option value="top-selling">Top Selling</option>
                                    <option value="low-price">Low Price</option>
                                    <option value="high-price">High Price</option>
                                    <option value="a-z">A - Z</option>
                                    <option value="z-a">Z - A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="d-block mb-3 d-xl-none btn btn-success w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-3">
                    <div class="card border-0 d-none d-xl-block">
                        <div class="card-body rounded">
                            <div class="h6 mb-4 fw-bold text-muted">Categories</div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="radio-slide me-auto"><input id="ctall" wire:click="changeall" {{ $categories ? '' : 'checked' }} class="form-check-input" type="radio">All Categories</div>
                                </div>
                            </div>
                            @foreach ($categories_list as $ct)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="radio-slide me-auto"><input class="form-check-input" id="ct{{ $ct->id }}" wire:model="categories" value="{{ $ct->slug }}"type="radio">{{ $ct->title }}</div>
                                        <small class="text-success">{{ $ct->product->count() }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <div class="h6 my-4 fw-bold text-muted">Tags</div>
                            @foreach ($tags_list as $tag)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="radio-slide me-auto"><input id="tags{{ $tag->id }}" wire:model="tags" value="{{ $tag->slug }}" class="form-check-input checkbox-i" type="checkbox">{{ $tag->name }}</div>
                                        <small class="text-success">{{ $tag->products->count() }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <button type="button" wire:click="resetall" class="btn btn-dark w-100 my-3">Reset All Filter</button>
                        </div>
                    </div>
                </div>
                <div class="col">

                    <div wire:loading.remove wire:target="categories">
                        <div wire:loading.remove wire:target="search">
                            <div wire:loading.remove wire:target="sort">
                                <div wire:loading.remove wire:target="price">
                                    <div wire:loading.remove wire:target="changeall">

                                        <div class="row row-cols-1 row-cols-xl-3">
                                            @foreach ($products as $row)
                                                <div class="col">
                                                    <div class="card border-0 mb-4 card-hover-top fades">
                                                        <a href="{!! route('front.product.detail', $row->slug) !!}"><img class="thumbnial-blog w-100" src="{!! $row->_thumbnail() !!}" alt="{{ $row->name }}"></a>
                                                        <div class="card-body" style="min-height: 140px;">
                                                            <div class="d-flex align-items-center tag-blog mb-2">
                                                                <div class="me-auto d-flex align-items-baseline">
                                                                    <div class="circle"></div> <a class="href" href="javascript:void(0)" wire:click="cate('{{ $row->category->slug }}')">{{ $row->category->title }}</a>
                                                                </div>
                                                                @if ($row->product_type == 'pay')
                                                                    <div class="currency-usd"><span class="text-success">$</span> {{ $row->price_usd }}</div>
                                                                    <div class="currency-idr"><span class="text-success">Rp.</span> {{ number_format($row->price_idr, 0, ',', '.') }}</div>
                                                                @else
                                                                    <span class="text-success noto__">FREE</span>
                                                                @endif
                                                            </div>
                                                            <a href="{!! route('front.product.detail', $row->slug) !!}" class="judul-blog">{{ $row->name }}</a>
                                                            <small class="text-muted sort-blog">{{ $row->meta_description }}</small>
                                                        </div>
                                                        <div class="card-footer blog-footer p-0">
                                                            <a href="{!! route('front.product.detail', $row->slug) !!}" class="btn btn-dark-btn btn-view-product"><i class="bi bi-view-list"></i> View</a>
                                                            @if ($row->product_type == 'free')
                                                                @if ($auth_user)
                                                                    @if ($row->isPurchased($row->id, $auth_user->id) > 0)
                                                                        <a href="{{ route('front.library.index') }}" class="btn btn-primary btn-buy-product"><i class="bi bi-wallet2"></i> My Library</a>
                                                                    @else
                                                                        <a href="{{ route('front.library.add', $row->id) }}" class="btn btn-primary btn-buy-product"><i class="bi bi-cart-plus"></i> Add Library</a>
                                                                    @endif
                                                                @else
                                                                    <a href="{{ route('front.library.add', $row->id) }}" class="btn btn-primary btn-buy-product"><i class="bi bi-cart-plus"></i> Add Library</a>
                                                                @endif
                                                            @else
                                                                @if ($auth_user)
                                                                    @if ($row->isPurchased($row->id, $auth_user->id) > 0)
                                                                        <a href="{{ route('front.library.index') }}" class="btn btn-primary btn-buy-product"><i class="bi bi-wallet2"></i> My Library</a>
                                                                    @else
                                                                        <button onclick="ilsyaa__payment____('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-payment" class="btn btn-primary btn-buy-product"><i class="bi bi-cart2"></i> Buy Now</button>
                                                                    @endif
                                                                @else
                                                                    <button onclick="ilsyaa__payment____('{{ $row->id }}')" data-bs-toggle="modal" data-bs-target="#modal-payment" class="btn btn-primary btn-buy-product"><i class="bi bi-cart2"></i> Buy Now</button>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{ $products->links('vendor.pagination.landing_livewire') }}
                </div>
            </div>
        </div>
    </section>

    <div wire:ignore.self class="offcanvas offcanvas-start text-light" style="background-color: #1b2536;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title" id="offcanvasExampleLabel">
                <i class="bi bi-app-indicator"></i> Filter
            </h6>
            <a href="javascript:void(0)" class="href text-muted" style="font-size: 20px" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-arrow-left-circle"></i></a>
        </div>
        <div class="offcanvas-body">
            <div class="card-body rounded">
                <div class="h6 mb-4 fw-bold text-muted">Categories</div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="radio-slide me-auto"><input id="ctall" wire:click="changeall" {{ $categories ? '' : 'checked' }} class="form-check-input" type="radio">All Categories</div>
                    </div>
                </div>
                @foreach ($categories_list as $ct)
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="radio-slide me-auto"><input class="form-check-input" id="ct{{ $ct->id }}" wire:model="categories" value="{{ $ct->slug }}"type="radio">{{ $ct->title }}</div>
                            <small class="text-success">{{ $ct->product->count() }}</small>
                        </div>
                    </div>
                @endforeach
                <div class="h6 my-4 fw-bold text-muted">Tags</div>
                @foreach ($tags_list as $tag)
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <div class="radio-slide me-auto"><input id="tags{{ $tag->id }}" wire:model="tags" value="{{ $tag->slug }}" class="form-check-input checkbox-i" type="checkbox">{{ $tag->name }}</div>
                            <small class="text-success">{{ $tag->products->count() }}</small>
                        </div>
                    </div>
                @endforeach
                <button type="button" wire:click="resetall" class="btn btn-dark w-100 my-3">Reset All Filter</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-payment" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <small class="text-muted">Payment Method</small>
                </div>
                <div class="modal-body border-0" id="payment-body">

                </div>
                <div class="modal-footer d-flex text-muted noto__ py-0">
                    <small><span class="fw-bold">esc</span> exit</small>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{!! asset('frontend/landing/vendor/jquery.min.js') !!}"></script>
        <script>
            function ilsyaa__payment____(id) {
                $('#payment-body').html('<div class="text-center my-5"><div class="spinner-grow" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                $.ajax({
                    url: "{{ route('front.payment.method') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#payment-body').html(data);
                    }
                });
            }
        </script>
    @endpush
</div>
