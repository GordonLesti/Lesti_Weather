<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 12.02.13
 * Time: 16:17
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Model_Weather_Speed
{
    const MILES_PER_HOUR = 'mph';
    const KILOMETERS_PER_HOUR = 'kmh';

    public function getUnitLabel($unit)
    {
        switch($unit) {
            case self::MILES_PER_HOUR: return 'mph';
            case self::KILOMETERS_PER_HOUR: return 'km/h';
        }
    }

}