<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
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

    public function __construct(
        TermAndConditionService $term_and_condition_service,
        PolicyService $policy_service,
        FaqService $faq_service
    ) {
        $this->term_and_condition_service = $term_and_condition_service;
        $this->policy_service = $policy_service;
        $this->faq_service = $faq_service;
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
}
