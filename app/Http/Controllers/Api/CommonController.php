<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Services\Concrete\AboutUsService;
use App\Services\Concrete\CountryService;
use App\Services\Concrete\CurrencyService;
use App\Services\Concrete\FaqService;
use App\Services\Concrete\PolicyService;
use App\Services\Concrete\TermAndConditionService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    use ResponseAPI;
    protected $term_and_condition_service;
    protected $policy_service;
    protected $faq_service;
    protected $currency_service;
    protected $country_service;
    protected $about_us_service;

    public function __construct(
        TermAndConditionService $term_and_condition_service,
        PolicyService $policy_service,
        FaqService $faq_service,
        CurrencyService $currency_service,
        CountryService $country_service,
        AboutUsService $about_us_service
    ) {
        $this->term_and_condition_service = $term_and_condition_service;
        $this->policy_service = $policy_service;
        $this->faq_service = $faq_service;
        $this->currency_service = $currency_service;
        $this->country_service = $country_service;
        $this->about_us_service = $about_us_service;
    }

    //currencies
    public function currency()
    {
        $currency = $this->currency_service->getAll();
        return $this->success(
            $currency,
            ResponseMessage::FETCHED
        );
    }
    //countries
    public function country()
    {
        $country = $this->country_service->getAllActive();
        return $this->success(
            $country,
            ResponseMessage::FETCHED
        );
    }
    //term and condition
    public function termAndCondition()
    {
        $term = $this->term_and_condition_service->getLatest();
        return $this->success(
            $term,
            ResponseMessage::FETCHED
        );
    }

    //privacy policy
    public function privacyPolicy()
    {
        $policy = $this->policy_service->getLatest();
        return $this->success(
            $policy,
            ResponseMessage::FETCHED
        );
    }

    //FAQs
    public function faqs()
    {
        $faq = $this->faq_service->getAll();
        return $this->success(
            $faq,
            ResponseMessage::FETCHED
        );
    }

    //about us
    public function aboutUs(){
        $about_us = $this->about_us_service->getLatest();
        return $this->success(
            $about_us,
            ResponseMessage::FETCHED
        );
    }
}
