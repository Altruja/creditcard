<?php

namespace Altruja;

class CreditCard {

  protected $nr;

  public function __construct($nr) {
    $this->nr = "$nr";
  }

  public function type() {

    $patterns = [
      'visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
      'mastercard' => '/^5[1-5][0-9]{14}$/',
      'amex' => '/^3[47][0-9]{13}$/',
      'diners' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
      'discover' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
      'jcb' => '/^(?:2131|1800|35\d{3})\d{11}$/',
      'any' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
    ];

    foreach ($patterns as $key=>$pattern) {
      if (preg_match($pattern, $this->nr)) {
        return $key;
      }
    }
  
    return false;
  }

  public function valid() {

    // source: https://gist.github.com/troelskn/1287893

    $number = $this->nr;

    settype($number, 'string');
    $sumTable = array(
      array(0,1,2,3,4,5,6,7,8,9),
      array(0,2,4,6,8,1,3,5,7,9));
    $sum = 0;
    $flip = 0;
    for ($i = strlen($number) - 1; $i >= 0; $i--) {
      $sum += $sumTable[$flip++ & 0x1][$number[$i]];
    }
    return $sum % 10 === 0;
  }
}

