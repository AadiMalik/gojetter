<?php

namespace App\Services\Concrete\Api;

use App\Models\Card;
use App\Models\CustomerCard;
use App\Repository\Repository;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Illuminate\Support\Facades\DB;

class CustomerCardService
{
      protected $model_customer_card;
      public function __construct()
      {
            // set the model
            $this->model_customer_card = new Repository(new CustomerCard());
      }
      public function list(){
            return $this->model_customer_card->getModel()::where('is_deleted',0)
            ->where('user_id',Auth::user()->id)->get();
      }
      public function save(array $data)
      {
            $user = Auth::user();
            Stripe::setApiKey(config('services.stripe.secret'));

            return DB::transaction(function () use ($data, $user) {

                  // Create Stripe customer if not exists
                  if (!$user->stripe_customer_id) {
                        $customer = Customer::create([
                              'email' => $user->email,
                              'name' => $user->name,
                        ]);
                        $user->stripe_customer_id = $customer->id;
                        $user->save();
                  }

                  // Attach payment method
                  $paymentMethod = PaymentMethod::retrieve($data['payment_method_id']);
                  $paymentMethod->attach(['customer' => $user->stripe_customer_id]);

                  // Optionally set default payment method
                  if (!empty($data['is_default'])) {
                        \Stripe\Customer::update($user->stripe_customer_id, [
                              'invoice_settings' => [
                                    'default_payment_method' => $data['payment_method_id']
                              ]
                        ]);
                  }

                  $obj = [
                        "user_id"                     => $user->id,
                        "is_default"                  => $data['is_default'] ?? false,
                        "stripe_payment_method_id"    => $data['payment_method_id'],
                        "card_brand"                  => $paymentMethod->card->brand,
                        "card_last_four"              => $paymentMethod->card->last4,
                        "exp_month"                   => $paymentMethod->card->exp_month,
                        "exp_year"                    => $paymentMethod->card->exp_year,
                        "card_holder_name"            => $paymentMethod->billing_details->name ?? $user->name,
                        "createdby_id"                => $user->id
                  ];
                  $card = $this->model_customer_card->create($obj);
                  return $card;
            });
      }
}
