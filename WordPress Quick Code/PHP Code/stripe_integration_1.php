<?php

function stripe_payment_gateway($form = array(), $subscription= true){ /* > > > If subscription or not (true or false) < < < */
	global $stripe_private_key;
	\Stripe\Stripe::setApiKey('sk_test_f7X4uqu0ywoxoOhokzpCfYD80053aeVkDO'); /* > > > Secret Key < < < */
	if ($subscription) {
		try {
			$customer = \Stripe\Customer::create(array(
				'email' => $form['email'],
				'card'  => $form['stripeToken'],
			));
			$subscription = \Stripe\Subscription::create([
				'customer' => $customer->id,
				'items' => [['plan' =>  $form['package'] ]],
			]);
			$err['stripe_customer']  		= $subscription->customer;
			$err['stripe_subscription']  	= $subscription->id;
			$err['status']  				= true;
		} catch(\Stripe\Error\Card $e) {
			// Since it's a decline, \Stripe\Error\Card will be caught
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$err['status']  = false;
		} catch (\Stripe\Error\RateLimit $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Too many requests made to the API too quickly
		} catch (\Stripe\Error\InvalidRequest $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Invalid parameters were supplied to Stripe's API
		} catch (\Stripe\Error\Authentication $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
		} catch (\Stripe\Error\ApiConnection $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Network communication with Stripe failed
		} catch (\Stripe\Error\Base $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Display a very generic error to the user, and maybe send
			// yourself an email
		} catch (Exception $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Something else happened, completely unrelated to Stripe
		}
		return $err;
	} else {

		try {
			$customer = \Stripe\Customer::create(array(
				'email' => $form['email'],
				'card'  => $form['stripeToken'],
			));
			$charge = \Stripe\Charge::create([
				'customer' => $customer->id,
				'amount'   => round($form['amount'] * 100),//amount shuld be in cent...
				'currency' => 'EUR',
			]);
			$err['stripe_charge'] = $charge['id'];
			$err['status']  = true;

		} catch(\Stripe\Error\Card $e) {
			// Since it's a decline, \Stripe\Error\Card will be caught
			$body = $e->getJsonBody();
			$err['error']  = $body['error']['message'];
			$err['status']  = false;
		} catch (\Stripe\Error\RateLimit $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Too many requests made to the API too quickly
		} catch (\Stripe\Error\InvalidRequest $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Invalid parameters were supplied to Stripe's API
		} catch (\Stripe\Error\Authentication $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
		} catch (\Stripe\Error\ApiConnection $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Network communication with Stripe failed
		} catch (\Stripe\Error\Base $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Display a very generic error to the user, and maybe send
			// yourself an email
		} catch (Exception $e) {
			$body = $e->getJsonBody();
			$err['error']  = $body['error'];
			$err['status']  = false;
			// Something else happened, completely unrelated to Stripe
		}
		return $err;
	}
}

function generate_token($formata = array()){
	global $stripe_private_key;
	\Stripe\Stripe::setApiKey('sk_test_f7X4uqu0ywoxoOhokzpCfYD80053aeVkDO'); /* > > > Secret Key < < < */
	try {
		$response = \Stripe\Token::create([
			'card' => [
				'number' => $formata['number'],
				'exp_month' =>  $formata['exp_month'],
				'exp_year' =>  $formata['exp_year'],
				'cvc' =>  $formata['cvc']
			]
		]);

		$err['token']  = $response['id'];
		$err['status']  = true;
	} catch(\Stripe\Error\Card $e) {
		// Since it's a decline, \Stripe\Error\Card will be caught
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
	} catch (\Stripe\Error\RateLimit $e) {
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
		// Too many requests made to the API too quickly
	} catch (\Stripe\Error\InvalidRequest $e) {
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
		// Invalid parameters were supplied to Stripe's API
	} catch (\Stripe\Error\Authentication $e) {
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
		// Authentication with Stripe's API failed
		// (maybe you changed API keys recently)
	} catch (\Stripe\Error\ApiConnection $e) {
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
		// Network communication with Stripe failed
	} catch (\Stripe\Error\Base $e) {
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
		// Display a very generic error to the user, and maybe send
		// yourself an email
	} catch (Exception $e){
		$body = $e->getJsonBody();
		$err['error']  = $body['error']['message'];
		$err['status']  = false;
		// Something else happened, completely unrelated to Stripe
	}
	return $err;
}