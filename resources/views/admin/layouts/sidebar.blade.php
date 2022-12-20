<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ route('dashboards') }}">
                    <div class="brand-logo">
                        <img src="{{ $websetting->logo() }}" alt="{{ $websetting->meta_title }}">
                    </div>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Route::is('dashboards') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('dashboards') }}">
                    <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather='trending-up'></i><span class="menu-title text-truncate" data-i18n="Analytics">Analytics</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('analytics.product.income') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('analytics.product.income') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Products Income">Products Income</span>
                        </a>
                    </li>
                    <li class="{{ isset($analytics_active_products) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('analytics.visitor', ['url' => 'products']) }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Products Income">Products Visitor</span>
                        </a>
                    </li>
                    <li class="{{ isset($analytics_active_blogs) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('analytics.visitor', ['url' => 'blogs']) }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Products Income">Blogs Visitor</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span data-i18n="Content">Content</span><i data-feather="more-horizontal"></i>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather='shopping-cart'></i><span class="menu-title text-truncate" data-i18n="Manage Products">Products</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('product.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('product.create') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Add New Products">Add New Product</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('product.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('product.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="All Products">All Products</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('product.categories.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('product.categories.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Manage Category">Manage Category</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('product.tags.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('product.tags.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Manage Tags">Manage Tags</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Manage blog">Blog</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('blogs.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('blogs.create') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Add New Blog">Add New Blog</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('blogs.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('blogs.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="All Blog">All Blog</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('blogs.categories.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('blogs.categories.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Manage Category">Manage Category</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('blogs.tags.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('blogs.tags.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Manage Tags">Manage Tags</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="layers"></i><span class="menu-title text-truncate" data-i18n="Site Pages">Site Pages</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('pages.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('pages.create') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Add New Page">Add New Page</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('pages.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('pages.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="All Page">All Page</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header"><span data-i18n="Other">Management</span><i data-feather="more-horizontal"></i>
            <li class="nav-item {{ Route::is('license.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('license.index') }}">
                    <i data-feather="hash"></i><span class="menu-title text-truncate" data-i18n="Manage License">Manage License</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="layers"></i><span class="menu-title text-truncate" data-i18n="Ownership License">Ownership License</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('product.license.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('product.license.index') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="License Product">License Product</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Route::is('payment.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('payment.index') }}">
                    <i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="Payment History">Payment History</span>
                </a>
            </li>

            <li class="nav-item {{ Route::is('users.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                    <i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="File Manager">Manage Users</span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather='message-square'></i><span class="menu-title text-truncate" data-i18n="Ownership License">Manage Comments</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ isset($comments_products_active) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('comments.index', 'products') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Product Comment">Product Comment</span>
                        </a>
                    </li>
                    <li class="{{ isset($comments_blogs_active) ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('comments.index', 'blogs') }}">
                            <i data-feather='chevron-right'></i><span class="menu-item text-truncate" data-i18n="Blog Comment">Blog Comment</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header"><span data-i18n="Settings">Settings</span><i data-feather="more-horizontal"></i>
            <li class="nav-item {{ Route::is('files.manager') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('files.manager') }}">
                    <i data-feather="folder"></i><span class="menu-title text-truncate" data-i18n="File Manager">File Manager</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('websetting.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('websetting.index') }}">
                    <i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Website Settings">Website Settings</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('webmaster.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('webmaster.index') }}">
                    <i data-feather="code"></i><span class="menu-title text-truncate" data-i18n="Web Master">Web Master</span>
                </a>
            </li>
        </ul>
    </div>
</div>
