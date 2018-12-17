<?php

namespace App\Http\Controllers\Backend;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Larapack\ConfigWriter\Repository as Repo;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;


class AdminSiteSettingsController extends Controller
{
    
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }
    
    public function index()
    {
        return view('backend._settings.settings');
    }
    
    public function updateSettings(Request $request)
    {
        if(config('demo.demo_mode')){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }
        $this->validate($request, [
            'organicSalesPercentage' => 'numeric|max:100|min:0',
            'promoSalesPercentage' => 'numeric|max:100|min:0',
            'contact_email' => 'sometimes|email',
            'affiliateSalesPercentage' => 'numeric|max:100|min:0',
            'affiliate_cookie_lifetime' => 'numeric|min:1',
            'minimumPayoutAmount' => 'numeric|min:1'
        ]);
        
        $config = new Repo('settings'); // loading the config from config/app.php
        
        $config->set('site_theme', $request->site_theme);
        $config->set('organicSalesPercentage', $request->organicSalesPercentage);
        $config->set('promoSalesPercentage', $request->promoSalesPercentage);
        
        $config->set('affiliateSalesPercentage', $request->affiliateSalesPercentage);
        $config->set('affiliate_cookie_lifetime', $request->affiliate_cookie_lifetime);
        $config->set('minimumPayoutAmount', $request->minimumPayoutAmount);
        
        $config->set('max_video_upload_size', $request->max_video_upload_size);
        $config->set('uploadLocation', $request->uploadLocation); // local or s3
        $request->send_emails ? $config->set('send_emails', true) : $config->set('send_emails', false);
        $request->allow_video_upload ? $config->set('allow_video_upload', true) : $config->set('allow_video_upload', false);
        $request->allow_youtube_video ? $config->set('allow_youtube_video', true) : $config->set('allow_youtube_video', false);
        $request->allow_vimeo_video ? $config->set('allow_vimeo_video', true) : $config->set('allow_vimeo_video', false);
        $request->allow_s3_video ? $config->set('allow_s3_video', true) : $config->set('allow_s3_video', false);
        $config->set('site_description', $request->site_description);
        $config->set('google_analytics', $request->google_analytics_code);
        $config->set('social_facebook', $request->social_facebook);
        $config->set('social_google', $request->social_google);
        $config->set('social_twitter', $request->social_twitter);
        $config->set('social_youtube', $request->social_youtube);
        $config->set('contact_email', $request->contact_email);
        $config->set('currency_code', $request->currency_code);
        $config->set('currency_symbol', $request->currency_symbol);
        $config->set('currency_symbol_position', $request->currency_symbol_position);
        $config->set('pricelist', $request->pricelist);
        
        $request->enable_stripe ? $config->set('enable_stripe', true) : $config->set('enable_stripe', false);
        $request->enable_paypal ? $config->set('enable_paypal', true) : $config->set('enable_paypal', false);
        $request->enable_braintree ? $config->set('enable_braintree', true) : $config->set('enable_braintree', false);
        $request->enable_omise ? $config->set('enable_omise', true) : $config->set('enable_omise', false);
        $request->enable_razorpay ? $config->set('enable_razorpay', true) : $config->set('enable_razorpay', false);
        
        $config->set('adsense_ad_client', $request->adsense_ad_client);
        $config->set('adsense_sidebar_responsive_slot', $request->adsense_sidebar_responsive_slot);
        $config->set('adsense_top_responsive_slot', $request->adsense_top_responsive_slot);
        
        $config->save();
        
        return redirect()->back();
    }
    
    public function editEnv()
    {
        $envConfig = $this->EnvironmentManager->getEnvContent();
        $languages = [];
        
        foreach (array_keys(config('locale.languages')) as $lang){
            $languages = array_add($languages, $lang, trans('menus.language-picker.langs.'.$lang));
        }
        return view('backend._settings.env', compact('envConfig', 'languages'));
    }
    
    public function saveEnv(Request $request)
    {
        if(config('demo.demo_mode')){
            return back()->withFlashDanger('Not allowed in Demo mode');
        }   
        $message = $this->EnvironmentManager->saveFileClassic($request);

        return redirect()->back()->with(['message' => $message]);
    }
}
