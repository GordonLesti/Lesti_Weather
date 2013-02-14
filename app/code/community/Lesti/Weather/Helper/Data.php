<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 11.02.13
 * Time: 21:49
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Helper_Data extends Mage_Core_Helper_Abstract
{
    public static function calculateTemperatureFromKelvin($temp,
                                                          $unit = Lesti_Weather_Model_Weather_Temperature::KELVIN,
                                                          $round = 1)
    {
        switch($unit) {
            case Lesti_Weather_Model_Weather_Temperature::KELVIN:
                $temp = $temp;
                break;
            case Lesti_Weather_Model_Weather_Temperature::CELSIUS:
                $temp =  $temp - 273.15;
                break;
            case Lesti_Weather_Model_Weather_Temperature::FAHRENHEI:
                $temp = ($temp - 273.15) *1.8 +32;
                break;
            case Lesti_Weather_Model_Weather_Temperature::RANKINE:
                $temp = $temp * 1.8;
                break;
            case Lesti_Weather_Model_Weather_Temperature::REAUMUR:
                $temp =($temp - 273.15) * 0.8;
                break;
        }
        return round($temp, $round);
    }

    public function calculateSpeedFromMps($speed,
                                          $unit = Lesti_Weather_Model_Weather_Speed::METER_PER_SECOND,
                                          $round = 1)
    {
        switch($unit) {
            case Lesti_Weather_Model_Weather_Speed::METER_PER_SECOND:
                $speed = $speed;
                break;
            case Lesti_Weather_Model_Weather_Speed::MILES_PER_HOUR:
                $speed = 2.237 * $speed;
                break;
            case Lesti_Weather_Model_Weather_Speed::KILOMETERS_PER_HOUR:
                $speed = 3.6 * $speed;
                break;
            case Lesti_Weather_Model_Weather_Speed::KNOT:
                $speed = 1.944 * $speed;
                break;
        }
        return round($speed, $round);
    }

}