<?php
namespace App;

/**
 *
 */
class PayPal
{
  private $_apiContext;
  private $shopping_cart;
  private $_ClienteId = 'AVTZ3aVhvYjXsk0H_1n797wJWJTpcvwvrbYo_aFwr5ltdJ4YDQhOC19fYQ3dDDnKz0L0d7cidK-gplJ0';
  private $_ClienteSecret = 'EHwcYyvnLE_RhVRViRj_j2nvQsYlpMnV20T5rGikONa6rEg0gR7ucj7f-OQGN1jPEmYqzBbZD8C1cZYU';

  public function __construct($shopping_cart)
  {
    $this->_apiContext = \Paypalpayment::apiContext($this->_ClienteId, $this->_ClienteSecret);
    $config = config("paypal_payment");
    $flatConfig = array_dot($config);
    $this->_apiContext->setConfig($flatConfig);
    $this->shopping_cart = $shopping_cart;
  }

  public function generate()
  {
    $payment =  \Paypalpayment::payment()->setIntent('sale')
                                    ->setPayer($this->payer())
                                    ->setTransactions([$this->transaction()])
                                    ->setRedirectUrls($this->redirectURLs());

    try {
      $payment->create($this->_apiContext);
    } catch (\Exception $e) {
      dd($e);
      exit(1);
    }
    return $payment;

  }

  public function payer()
  {
    //return payment Information
    return \Paypalpayment::payer()->setPaymentMethod('paypal');
  }
  public function redirectURLs()
  {
    $baseURL = url('/');
    return \Paypalpayment::redirectUrls()
                          ->setReturnUrl("$baseURL/payments/store")
                          ->setCancelUrl("$baseURL/carrito");


  }
  public function transaction()
  {
    return \Paypalpayment::transaction()->setAmount($this->amount())
      ->setItemList($this->items())
      ->setDescription("Tu compra en programacion jje")
      ->setInvoiceNumber(uniqid());
  }
  public function items()
  {
    $items = [];
    $products = $this->shopping_cart->productos()->get();
    foreach ($products as $product) {
      array_push($items, $product->paypalItem());
    }
    return \Paypalpayment::itemList()->setItems($items);
  }
  public function amount()
  {
    return \Paypalpayment::amount()->setCurrency('USD')
                                  ->setTotal($this->shopping_cart->totalUSD());
  }

  public function execute($paymentId, $payerId)
  {
    $payment = \Paypalpayment::getById($paymentId, $this->_apiContext);

    $execution = \Paypalpayment::PaymentExecution()->setPayerId($payerId);

    return $payment->execute($execution, $this->_apiContext);
  }

}



 ?>
