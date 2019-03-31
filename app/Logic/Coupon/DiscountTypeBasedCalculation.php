<?php
/**
 * Discount type based calculation single action class, which focus more on the bossiness side
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */
namespace App\Logic\Coupon;

use App\Core\Controllers\Abstracts\SingleAction;

/**
 * @package App\Http\Controllers
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */

class DiscountTypeBasedCalculation extends SingleAction
{
    /**
     * calculate discount based on given coupon discount type
     *
     * @param float $totalAmount
     * @param string $discountType
     * @param float $couponDiscountAmountCriteria
     * @return float
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function calculate($totalAmount, $discountType, $couponDiscountAmountCriteria) {
        $totalAfterDiscount = 0;
        switch ($discountType){
            case 'percentage':
                $totalAfterDiscount = $couponDiscountAmountCriteria * $totalAmount/100;
                break;
            case 'fixed':
                $totalAfterDiscount = $totalAmount - $couponDiscountAmountCriteria;
                break;
        }
        return $totalAfterDiscount;
    }
}
