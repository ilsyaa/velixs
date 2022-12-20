@extends('frontend.layouts.landing')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex mb-3">
                <div class="me-auto">
                    <h6 class="text-muted fw-bold"><span class="title-gradient">Explore</span> Items</h6>
                </div>
                <small class="text-muted">Items <span class="text-success">1000</span></small>
            </div>
            <div class="card mb-3 border-0">
                <div class="card-body rounded pb-0">
                    <div class="row row-cols-1 row-cols-xl-3 d-flex">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="search-group-icon__ input-group-text text-muted"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control search-group-input__" placeholder="Search Item">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="select-group-icon__ input-group-text text-muted"><i class="bi bi-wallet2"></i></span>
                                <select class="form-select select-group-input__" aria-label="Default select example">
                                    <option value="1">All</option>
                                    <option value="2">Pay</option>
                                    <option value="3">Free</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="select-group-icon__ input-group-text text-muted"><i class="bi bi-sort-alpha-up"></i></span>
                                <select class="form-select select-group-input__" aria-label="Default select example">
                                    <option>Latest</option>
                                    <option>Top Selling</option>
                                    <option>Low Price</option>
                                    <option>High Price</option>
                                    <option>A - Z</option>
                                    <option>Z - A</option>
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
                                    <div class="radio-slide me-auto"><input class="form-check-input" name="categories" type="radio">All Categories</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="radio-slide me-auto"><input class="form-check-input" name="categories" type="radio">Web Application</div>
                                    <small class="text-success">10</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="radio-slide me-auto"><input class="form-check-input" name="categories" type="radio">Web Template</div>
                                    <small class="text-success">1</small>
                                </div>
                            </div>
                            <div class="h6 my-4 fw-bold text-muted">Tags</div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="radio-slide me-auto"><input class="form-check-input checkbox-i" type="checkbox">Web Template</div>
                                    <small class="text-success">1</small>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="radio-slide me-auto"><input class="form-check-input checkbox-i" type="checkbox">Web Template</div>
                                    <small class="text-success">1</small>
                                </div>
                            </div>
                            <button class="btn btn-dark w-100 my-3">Reset All Filter</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row row-cols-1 row-cols-xl-3">
                        <div class="col">
                            <div class="card border-0 mb-4 card-hover-top">
                                <a href=""><img class="thumbnial-blog w-100" src="{!! asset('storage/product/thumbnails/gnAn9FkCsbr2iQBsrbcVZI7da4ZWhb3xXrQ6yfum.jpg') !!}" alt=""></a>
                                <div class="card-body ">
                                    <div class="d-flex align-items-center tag-blog mb-2">
                                        <div class="me-auto d-flex align-items-baseline">
                                            <div class="circle"></div> <a class="href" href="">Web Application</a>
                                        </div>
                                        <div class="currency-usd"><span class="text-success">$</span> 20.00</div>
                                        <div class="currency-idr"><span class="text-success">Rp.</span> 100.000</div>
                                    </div>
                                    <a href="" class="judul-blog">Judul Products Item Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequatur, dolore.</a>
                                    <small class="text-muted sort-blog">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, omnis ea. Ut?
                                    </small>
                                </div>
                                <div class="card-footer blog-footer p-0">
                                    <button class="btn btn-dark-btn btn-view-product"><i class="bi bi-view-list"></i> View</button>
                                    <button class="btn btn-primary btn-buy-product"><i class="bi bi-cart2"></i> Buy Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="offcanvas offcanvas-start text-light" style="background-color: #1b2536;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
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
                        <div class="radio-slide me-auto"><input class="form-check-input" name="categories" type="radio">All Categories</div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="radio-slide me-auto"><input class="form-check-input" name="categories" type="radio">Web Application</div>
                        <small class="text-success">10</small>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="radio-slide me-auto"><input class="form-check-input" name="categories" type="radio">Web Template</div>
                        <small class="text-success">1</small>
                    </div>
                </div>
                <div class="h6 my-4 fw-bold text-muted">Tags</div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="radio-slide me-auto"><input class="form-check-input checkbox-i" type="checkbox">Web Template</div>
                        <small class="text-success">1</small>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="radio-slide me-auto"><input class="form-check-input checkbox-i" type="checkbox">Web Template</div>
                        <small class="text-success">1</small>
                    </div>
                </div>
                <button class="btn btn-dark w-100 my-3">Reset All Filter</button>
            </div>
        </div>
    </div>

    

    <div class="container container-nav d-flex justify-content-end">
        <div id="change-currency" data-toggle="tooltip" data-placement="top" title="Change currency." class="currency">USD</div>
    </div>
@endsection
