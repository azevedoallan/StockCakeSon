<?php

namespace Stock\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * StockStatus helper
 */
class StockStatusHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function status(int $quantity, int $alert_quantity)
    {
        $warningAlertQuantity = $alert_quantity * 1.5;
        if ($quantity < $alert_quantity) {
            return 'danger';
        } elseif ($quantity < $warningAlertQuantity) {
            return 'warning';
        }
        return '';
    }
}
