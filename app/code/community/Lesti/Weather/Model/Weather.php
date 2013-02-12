<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 12.02.13
 * Time: 15:58
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Model_Weather
{
    const XML_PATH_LAT = 'general/weather/lat';
    const XML_PATH_LON = 'general/weather/lon';
    const XML_PATH_TEMP_UNIT = 'general/weather/temp_unit';
    const XML_PATH_SPEED_UNI = 'general/weather/speed_unit';

    protected $_openweathermap_url = 'http://api.openweathermap.org/data/2.1/find/city';
    protected $_curl_opt_timeout = 60;
    protected $_cache_key = 'lesti_weather';
    protected $_weather = null;

    public function __construct()
    {
        $cache = Mage::getSingleton('core/cache');
        $this->_weather = unserialize($cache->load($this->_cache_key));
        if(is_null($this->_weather)) {
            $this->_weather = $this->_getWeather();
            $cache->save(serialize($this->_weather), $this->_cache_key, array(), 900);
        }
    }

    public function getTemperature()
    {
        if(isset($this->_weather['temp'])) {
            $unit = Mage::getStoreConfig(self::XML_PATH_TEMP_UNIT);
            return Mage::helper('weather')->calculateTemperatureFromKelvin($this->_weather['temp'], $unit);
        }
        return '';
    }

    public function getWind()
    {
        if(isset($this->_weather['wind'])) {
            $unit = Mage::getStoreConfig(self::XML_PATH_SPEED_UNI);
            return Mage::helper('weather')->calculateSpeedFromMps($this->_weather['wind'], $unit);
        }
        return '';
    }

    public function getWeatherDescription()
    {
        return isset($this->_weather['desc']) ? $this->_weather['desc'] : '';
    }

    protected function _getWeather()
    {
        $curl = new Varien_Http_Adapter_Curl();
        $curl->setConfig(array(
            'timeout'   => $this->_curl_opt_timeout
        ));
        $url = $this->_openweathermap_url . '?lat=' . $this->_getLat() . '&lon=' . $this->_getLon();
        $curl->write(Zend_Http_Client::GET, $url);
        $data = $curl->read();
        $curl->close();
        $data = preg_split('/^\r?$/m', $data, 2);
        $data = json_decode(trim($data[1]));
        $list = $data->list;
        $weather = array();
        if(isset($list[0])) {
            $weather['temp'] = $list[0]->main->temp;
            $weather['wind'] = $list[0]->wind->speed;
            $weather['desc'] = $list[0]->weather->description;
        }
        return $weather;
    }

    protected function _getLat()
    {
        return Mage::getStoreConfig(self::XML_PATH_LAT);
    }

    protected function _getLon()
    {
        return Mage::getStoreConfig(self::XML_PATH_LON);
    }

}