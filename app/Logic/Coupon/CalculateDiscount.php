<?php
/**
 * Calculate coupon discount single action class, which focus more on the logic side
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */
namespace App\Logic\Coupon;

use App\Core\Controllers\Abstracts\SingleAction;
use App\Logic\Coupon\CartDiscountFiltration;
use App\Validation\Coupon\ValidateAmount;
use App\Validation\Coupon\ValidateExpireDate;
use Mockery\Exception;

/**
 * @package App\Logic\Coupon
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */

class CalculateDiscount extends SingleAction
{
    /**
     * Calculate client discounted value.
     *
     * @param \stdClass $order
     * @param \stdClass $coupon
     * @return float
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function calculate($order, $coupon) {
        try{
            (new ValidateExpireDate())->validate($coupon);
            (new ValidateAmount())->validate($coupon->minimum_amount, $order->total_cart);
            /** Filter cart items and return only coupon criteria passed cart items */
            $filteredCart = (new CartDiscountFiltration())->filter($order->cart_content, $coupon);
            $filteredCartTotalAmount = array_sum(array_column($filteredCart, 'product_price'));
            if($coupon->free_shipping)
                $totalAmount = $order->shipping_cost + $filteredCartTotalAmount;
            else
                $totalAmount = $filteredCartTotalAmount;
            return (new DiscountTypeBasedCalculation())->calculate($totalAmount, $coupon->type, $coupon->amount);
        } catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }
}
