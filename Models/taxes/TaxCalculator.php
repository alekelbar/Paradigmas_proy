<?php
/**
 * @return the creation of a new salary with taxes
 */
class TaxCalculator
{
  public static $taxes = array(0.055, 0.035, 0.01, 0.025);
  public static function cal($salary)
  {
    foreach (self::$taxes as $tax) {
      $salary -= $salary * $tax;
    }
    return $salary;
  }
}
