<?php
/**
 * class to assign taxes to employees.
 */
class TaxCalculator
{
  /**
   * taxes is an arrangement that contains all the different taxes that must be deducted from the employee's salary. 
   * @return the creation of a new salary with taxes.
   */
  public static $taxes = array(0.055, 0.035, 0.01, 0.025);
  public static function cal($salary)
  {
    foreach (self::$taxes as $tax) {
      $salary -= $salary * $tax;
    }
    return $salary;
  }
}
