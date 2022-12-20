<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Metavis;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogView;
use App\Models\Page;
use App\Models\PageView;
use App\Models\Product;
use App\Models\ProductLibrary;
use App\Models\ProductViews;
// use Illuminate\Http\Request;
use Carbon\Carbon;


class AnalyticsController extends Controller
{
    public function index()
    {
        $daysInMonth = [];
        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $daysInMonth[] = $i;
        }

        // show json visitor per day
        $visitorPerDay_master = [];
        $visitorPerDay_page = [];
        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $visitorPerDay_master[] = PageView::whereDate('created_at', Carbon::now()->format('Y-m-' . $i))->where('page_index', '=', 'master')->count();
            $visitorPerDay_page[] = PageView::whereDate('created_at', Carbon::now()->format('Y-m-' . $i))->where('page_index', '!=', 'master')->count();
        }

        $visitorCountry = [];
        $visitorCountryCount = [];
        foreach (PageView::selectRaw('country, count(*) as total')->groupBy('country')->orderBy('total', 'desc')->limit(7)->get() as $cn) {
            $visitorCountry[] = $cn->country;
            $visitorCountryCount[] = $cn->total;
        }

        $library = ProductLibrary::__get_total();
        return Metavis::lyna('admin/analytics/index', [
            'title' => 'Dashboards',
            'product_income_idr' => $library->first()->total_idr,
            'product_income_usd' => $library->first()->total_usd,
            'product_count' => Product::count(),
            'blog_count' => Blog::count(),
            'page_count' => Page::count(),
            'browser' => PageView::__countBrowser()->get(),
            'daily_visitor' => PageView::whereDate('created_at', date('Y-m-d'))->count(),
            'daysinmonth' => json_encode($daysInMonth),
            'visitorperday_master' => json_encode($visitorPerDay_master),
            'visitorperday_page' => json_encode($visitorPerDay_page),
            'visitorcountry' => json_encode($visitorCountry),
            'visitorcountrycount' => json_encode($visitorCountryCount),
        ]);
    }

    public function product_income()
    {
        $products_income = ProductLibrary::__income();

        $products_total = ProductLibrary::join('products', 'products.id', '=', 'product_libraries.product_id')
            ->selectRaw('SUM(products.price_idr) as total_idr, SUM(products.price_usd) as total_usd')
            ->whereNull('product_libraries.payment_id')
            ->orWhere('product_libraries.payment_id', '!=', 'free');
        return Metavis::lyna('admin.analytics.income', [
            'title' => 'Income Products',
            'product_income' => $products_income->get(),
            'product_income_idr' => $products_total->first()->total_idr,
            'product_income_usd' => $products_total->first()->total_usd,
            'product_income_idr_today' => $products_total->whereDate('product_libraries.created_at', date('Y-m-d'))->first()->total_idr,
            'product_income_usd_today' => $products_total->whereDate('product_libraries.created_at', date('Y-m-d'))->first()->total_usd,
        ]);
    }

    public function visitor($url)
    {
        if ($url == 'products') {
            return $this->visitor_products();
        } else if ($url == 'blogs') {
            return $this->visitor_blog();
        }
    }

    public function visitor_blog()
    {
        $daysInMonth = [];
        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $daysInMonth[] = $i;
        }

        if (request()->query('id')) {
            $title = Blog::find(request()->query('id'));
            if ($title) {
                $title = "Analytics Blog " . "<span style='color: #05ff92'>" . $title->title . "</span>";
            } else {
                $title = 'Blog Not Found';
            }
            // get visitor
            $visitorperday = [];
            for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
                $visitorperday[] = BlogView::whereDate('created_at', Carbon::now()->format('Y-m-' . $i))->where('blog_id', request()->query('id'))->count();
            }
            // get country
            $visitorCountry = [];
            $visitorCountryCount = [];
            foreach (BlogView::selectRaw('country, count(*) as total')->where('blog_id', request()->query('id'))->groupBy('country')->orderBy('total', 'desc')->limit(7)->get() as $cn) {
                $visitorCountry[] = $cn->country;
                $visitorCountryCount[] = $cn->total;
            }
            $browser = BlogView::__countBrowser()->where('blog_id', request()->query('id'))->get();
        } else {
            $title = 'Visitor All Blog';
            // get visitor
            $visitorperday = [];
            for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
                $visitorperday[] = BlogView::whereDate('created_at', Carbon::now()->format('Y-m-' . $i))->count();
            }
            // get country
            $visitorCountry = [];
            $visitorCountryCount = [];
            foreach (BlogView::selectRaw('country, count(*) as total')->groupBy('country')->orderBy('total', 'desc')->limit(7)->get() as $cn) {
                $visitorCountry[] = $cn->country;
                $visitorCountryCount[] = $cn->total;
            }
            // get browser
            $browser = BlogView::__countBrowser()->get();
        }
        return Metavis::lyna('admin.analytics.visitor', [
            'title' => $title,
            'daysinmonth' => json_encode($daysInMonth),
            'browser' => $browser,
            'visitorperday' => json_encode($visitorperday),
            'visitorcountry' => json_encode($visitorCountry),
            'visitorcountrycount' => json_encode($visitorCountryCount),
            'analytics_active_blogs' => true,
        ]);
    }

    public function visitor_products()
    {
        $daysInMonth = [];
        for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
            $daysInMonth[] = $i;
        }

        if (request()->query('id')) {
            $title = Product::find(request()->query('id'));
            if ($title) {
                $title = "Analytics Product " . "<span style='color: #05ff92'>" . $title->name . "</span>";
            } else {
                $title = 'Product Not Found';
            }
            // get visitor
            $visitorperday = [];
            for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
                $visitorperday[] = ProductViews::whereDate('created_at', Carbon::now()->format('Y-m-' . $i))->where('product_id', request()->query('id'))->count();
            }
            // get country
            $visitorCountry = [];
            $visitorCountryCount = [];
            foreach (ProductViews::selectRaw('country, count(*) as total')->where('product_id', request()->query('id'))->groupBy('country')->orderBy('total', 'desc')->limit(7)->get() as $cn) {
                $visitorCountry[] = $cn->country;
                $visitorCountryCount[] = $cn->total;
            }
            $browser = ProductViews::__countBrowser()->where('product_id', request()->query('id'))->get();
        } else {
            $title = 'Visitor All Products';
            // get visitor
            $visitorperday = [];
            for ($i = 1; $i <= Carbon::now()->daysInMonth; $i++) {
                $visitorperday[] = ProductViews::whereDate('created_at', Carbon::now()->format('Y-m-' . $i))->count();
            }
            // get country
            $visitorCountry = [];
            $visitorCountryCount = [];
            foreach (ProductViews::selectRaw('country, count(*) as total')->groupBy('country')->orderBy('total', 'desc')->limit(7)->get() as $cn) {
                $visitorCountry[] = $cn->country;
                $visitorCountryCount[] = $cn->total;
            }
            // get browser
            $browser = ProductViews::__countBrowser()->get();
        }

        return Metavis::lyna('admin.analytics.visitor', [
            'title' => $title,
            'daysinmonth' => json_encode($daysInMonth),
            'browser' => $browser,
            'visitorperday' => json_encode($visitorperday),
            'visitorcountry' => json_encode($visitorCountry),
            'visitorcountrycount' => json_encode($visitorCountryCount),
            'analytics_active_products' => true,
        ]);
    }
}
