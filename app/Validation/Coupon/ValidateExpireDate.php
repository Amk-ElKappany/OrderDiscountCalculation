<?php
/**
 * Validate coupon discount single action class
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

class ValidateExpireDate
{
    
    /**
     * Validate given coupon expire date.
     *
     * @param \stdClass $coupon
     * @return boolean
     * @throws \Exception $exception
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function validate($coupon) {
        if($coupon->end_date > time())
            return true;
        else
            throw new \Exception(trans('coupon.validation.expired'));
    }
}
