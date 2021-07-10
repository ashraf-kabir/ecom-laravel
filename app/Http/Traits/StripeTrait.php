<?php

namespace App\Http\Traits;

trait StripeTrait
{
  public function stripe_charge($total_price, $stripe_card_token)
  {
    $stripe_secret_key = env('STRIPE_SECRET_KEY');

    $stripe = new \Stripe\StripeClient(
      $stripe_secret_key
    );

    if (!empty($total_price) && !empty($stripe_card_token))
    {
      try
      {
        $charge = $stripe->charges->create([
          'amount'      => $total_price * 100,
          'currency'    => 'usd',
          'source'      => $stripe_card_token,
          'description' => 'Test Product Charge'
        ]);

        $output['success'] = TRUE;
        $output['charge']  = $charge;
        return $output;
        exit();
      }
      catch (\Stripe\Exception\CardException $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
      catch (\Stripe\Exception\RateLimitException $e)
      {
        // Too many requests made to the API too quickly
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
      catch (\Stripe\Exception\InvalidRequestException $e)
      {
        // Invalid parameters were supplied to Stripe's API
        // echo 'Message is:' . $e->getError()->message . '\n';

        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
      catch (\Stripe\Exception\AuthenticationException $e)
      {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiConnectionException $e)
      {
        // Network communication with Stripe failed
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
      catch (\Stripe\Exception\ApiErrorException $e)
      {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
      catch (\Exception $e)
      {
        $output['error']     = TRUE;
        $output['error_msg'] = $e->getMessage();
        return $output;
        exit();
      }
    }
    else
    {
      $output['error']     = TRUE;
      $output['error_msg'] = "Error! Please fill data correctly.";
      return $output;
      exit();
    }
  }
}
