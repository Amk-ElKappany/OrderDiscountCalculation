<?php
/**
 * Cart Discount Filtration single action class, which focus more on the bossiness side
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

class CartDiscountFiltration extends SingleAction
{
    /**
     * filter cart given item according to discount coupon criteria.
     *
     * @param array $cart
     * @param \stdClass $coupon
     * @return array
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function filter($cart, $coupon) {
        return array_filter($cart, function($cartItem) use($coupon) {
            if((in_array($cartItem['category_id'],$coupon->included_categories) && !in_array($cartItem['product_id'],$coupon->excluded_products)) || (in_array($cartItem['product_id'],$coupon->included_products)))
                return true;
            else
                return false;
        });
    }
}
