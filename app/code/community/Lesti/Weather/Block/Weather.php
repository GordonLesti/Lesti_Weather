<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 12.02.13
 * Time: 15:43
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Block_Weather extends Mage_Core_Block_Template
{
    protected $_weather = null;

    public function getWeather()
    {
        if(is_null($this->_weather)) {
            $this->_weather = Mage::getModel('weather/weather');
        }
        return $this->_weather;
    }

}