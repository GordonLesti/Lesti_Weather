<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 12.02.13
 * Time: 16:18
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Model_Weather_Temperature
{
    const KELVIN = 'K';
    const GRAD_CELSIUS = 'C';
    const GRAD_FAHRENHEI = 'F';
    const GRAD_RANKINE = 'R';

    public function getUnitLabel($unit)
    {
        switch($unit) {
            case self::KELVIN: return 'K';
            case self::GRAD_CELSIUS: return '&deg;C';
            case self::GRAD_FAHRENHEI: return '&deg;F';
            case self::GRAD_RANKINE: return '&deg;Ra';
        }
    }
}