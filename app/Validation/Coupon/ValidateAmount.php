<?php
/**
 * validate order total amount action class, which focus more on the bossiness side
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */
namespace App\Validation\Coupon;

/**
 * @package App\Validation\Coupon
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */

class ValidateAmount
{
    
    /**
     * Validate given order amount according to coupon criteria.
     *
     * @param  float $couponAmountCriteria
     * @param  float $cartTotalAmount
     * @return boolean
     * @throws \Exception $exception
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function validate($couponAmountCriteria, $cartTotalAmount) {
        if($cartTotalAmount >= $couponAmountCriteria)
            return true;
        else
            throw new \Exception(trans('coupon.validation.amount'));
    }
}
