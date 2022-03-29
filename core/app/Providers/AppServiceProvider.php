<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\User;
use App\Models\Article;
use App\Models\Deposit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\PolicyPage;
use App\Models\Withdrawal;
use App\Models\SupportTicket;
use App\Models\GeneralSetting;
use App\Models\SocialMediaLink;
use App\Models\AdminNotification;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['request']->server->set('HTTPS', true);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $activeTemplate = activeTemplate();
        $general = GeneralSetting::first();
        $viewShare['general'] = $general;
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        $viewShare['language'] = Language::all();
        $viewShare['categories'] = Category::where('status', 1)->with('subCategory', 'product')->get();
        $viewShare['pages'] = Page::where('tempname',$activeTemplate)->where('is_default',0)->get();
        $viewShare['signUpPolicy']=PolicyPage::where('slug','how-to-sign-up')->first();
        $viewShare['makeNFTPolicy']=PolicyPage::where('slug','how-to-make-an-nft')->first();
        $viewShare['privacyPolicy']=PolicyPage::where('slug','privacy-policy')->first();
        $viewShare['servicePolicy']=PolicyPage::where('slug','service-policy')->first();
        $viewShare['socialMediaLinks'] = SocialMediaLink::first();
        $viewShare['articles']=Article::get();
        view()->share($viewShare);
        

        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'banned_users_count'           => User::banned()->count(),
                'email_unverified_users_count' => User::emailUnverified()->count(),
                'sms_unverified_users_count'   => User::smsUnverified()->count(),
                'pending_ticket_count'         => SupportTicket::whereIN('status', [0,2])->count(),
                'pending_deposits_count'    => Deposit::pending()->count(),
                'pending_withdraw_count'    => Withdrawal::pending()->count(),
                'pending_product_count'    => Product::where('status', 0)->count(),
            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications'=>AdminNotification::where('read_status',0)->with('user')->orderBy('id','desc')->get(),
            ]);
        });


        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        // if($general->force_ssl){
            \URL::forceScheme('http');
        // }
        \Illuminate\Pagination\AbstractPaginator::currentPathResolver(function () {
            /** @var \Illuminate\Routing\UrlGenerator $url */
           $url = app('url');
           return $url->current();
        });

        Paginator::useBootstrap();
        
    }
}
