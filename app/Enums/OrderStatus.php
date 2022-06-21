<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum
{
    const PLACED = 'placed';
    const SHIPPED = 'shipped';
    const CANCELLED = 'cancelled';
    const DELIVERED = 'delivered';
    const STILL_INSHOPPING_CART = 'still_in_shopping_cart';
    const CONFIRMING_AND_PROCESSING = 'confirming_and_processing';
    const OUT_FOR_DELIVERY = 'out_for_delivery';
    const RETURNED = 'returned';
    const RETURN_IN_PROGRESS = 'return_in_progress';
}
