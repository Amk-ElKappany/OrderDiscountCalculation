<?php
/**
 * Cart Check out single action class, which focus more on the bossiness side
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */
namespace App\Http\Controllers;

use App\Core\Controllers\Abstracts\SingleAction;
use App\Logic\Coupon\CalculateDiscount;

/**
 * @package App\Http\Controllers
 *
 * @author Amk El-Kabbany at 31 March 2019
 * @contact amk.elkabbany@gmail.com
 */

class CartCheckOut extends SingleAction
{

    /**
     * @assumption 1- As many online shopping sites, discount operates after adding the shipping cost on the cart total price.
     *             2- Coupon minimum amount refer to total cart price, not total items count.
     *             3- Discount happens if one of the following passed:
     *                     a- The category is included and the product is NOT excluded.
     *                     b- The product is included even if the category is NOT included.
     */

    /**
     * The order object, contain all order data.
     *
     * @var /stdClass
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    protected $order;

    /**
     * The coupon object, contain all coupon data.
     *
     * @var /stdClass
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    protected $coupon;

    /**
     * Calculate Coupon Constructor.
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function __construct() {
        /**
         * Prepare $order object with needed data.
         */
        $this->order = new \stdClass();
        $this->order->total_cart = 175;
        $this->order->shipping_cost = 50;
        $this->order->customer_id   = 101;
        $this->order->cart_content  = [
            ['product_id' => 1, 'product_name' => 'Book', 'product_price' => 5, 'category_id' => 10],
            ['product_id' => 2, 'product_name' => 'Pen', 'product_price' => 1, 'category_id' => 20],
            ['product_id' => 3, 'product_name' => 'Bag', 'product_price' => 120, 'category_id' => 30],
            ['product_id' => 4, 'product_name' => 'Notebook', 'product_price' => 35, 'category_id' => 40],
            ['product_id' => 5, 'product_name' => 'Pencil Case', 'product_price' => 14, 'category_id' => 50]
        ];

        /**
         * Prepare $coupon object with needed data.
         */
        $this->coupon= new \stdClass();
        $this->coupon->type  = 'percentage'; // fixed, percentage
        $this->coupon->amount= 20;// Based on type
        $this->coupon->end_date= strtotime("+1 day");
        $this->coupon->minimum_amount= 100;
        $this->coupon->free_shipping = false; // true, false
        $this->coupon->included_categories= [10, 20];
        $this->coupon->excluded_categories= [50];
        $this->coupon->included_products  = [3];
        $this->coupon->excluded_products  = [4, 1];
    }
    
    /**
     * Calculate client supposed discounted value.
     *
     * @return float
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    public function checkOut() {
         return  (new CalculateDiscount())->calculate($this->order, $this->coupon);
    }
}
