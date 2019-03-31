<?php

    /**
     * Coupon Module routes
     *
     * @author Amk El-Kabbany at 31 March 2019
     * @contact amk.elkabbany@gmail.com
     */
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Discount Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/cart-check-out', ['as' => 'coupon.cart-checkout', 'uses' => 'CartCheckOut@checkOut']);
