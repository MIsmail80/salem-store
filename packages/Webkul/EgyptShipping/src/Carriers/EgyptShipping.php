<?php

namespace Webkul\EgyptShipping\Carriers;

use Webkul\Checkout\Facades\Cart;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Shipping\Carriers\AbstractShipping;

class EgyptShipping extends AbstractShipping
{
    /**
     * Shipping method carrier code.
     *
     * @var string
     */
    protected $code = 'egyptshipping';

    /**
     * Shipping method code.
     *
     * @var string
     */
    protected $method = 'egyptshipping_egyptshipping';

    /**
     * Calculate rate for Egypt shipping based on governorate.
     *
     * @return \Webkul\Checkout\Models\CartShippingRate|false
     */
    public function calculate()
    {
        if (!$this->isAvailable()) {
            return false;
        }

        $cart = Cart::getCart();

        if (!$cart || !$cart->shipping_address) {
            return false;
        }

        $shippingAddress = $cart->shipping_address;

        // Only apply for Egypt addresses
        if ($shippingAddress->country !== 'EG') {
            return false;
        }

        return $this->getRate();
    }

    /**
     * Get the shipping rate based on the selected governorate.
     *
     * @return \Webkul\Checkout\Models\CartShippingRate
     */
    public function getRate(): CartShippingRate
    {
        $cart = Cart::getCart();
        $shippingAddress = $cart->shipping_address;

        // Get the state code from the shipping address
        $stateCode = $shippingAddress->state;

        // Try to get the specific rate for this governorate
        $rate = $this->getGovernorateRate($stateCode);

        // If no specific rate, use default
        if ($rate === null || $rate === '') {
            $rate = $this->getConfigData('default_rate') ?? 50;
        }

        $rate = (float) $rate;

        $cartShippingRate = new CartShippingRate;

        $cartShippingRate->carrier = $this->getCode();
        $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'Egypt Shipping';
        $cartShippingRate->method = $this->getMethod();
        $cartShippingRate->method_title = $this->getConfigData('title') ?? 'Egypt Shipping';
        $cartShippingRate->method_description = $this->getConfigData('description') ?? 'Shipping within Egypt';
        $cartShippingRate->price = core()->convertPrice($rate);
        $cartShippingRate->base_price = $rate;

        return $cartShippingRate;
    }

    /**
     * Get the shipping rate for a specific governorate.
     *
     * @param  string|null  $stateCode
     * @return string|null
     */
    protected function getGovernorateRate(?string $stateCode): ?string
    {
        if (empty($stateCode)) {
            return null;
        }

        // The config key follows the pattern: sales.carriers.egyptshipping.{STATE_CODE}
        return core()->getConfigData('sales.carriers.egyptshipping.' . $stateCode);
    }
}
