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
    const XML_PATH_LOCATION = 'general/weather/location';

    protected $_openweathermap_url = 'http://api.openweathermap.org/data/2.1/find/city';
    protected $_curl_opt_timeout = 30;
    protected $_cache_key = 'weather_data';
    protected $_weather = null;
    protected $_temp_unit = null;
    protected $_wind_unit = null;

    public function __construct()
    {
        $cache = Mage::getSingleton('core/cache');
        $this->_weather = unserialize($cache->load($this->_cache_key));
        if(!is_array($this->_weather) || count($this->_weather) == 0) {
            $this->_weather = $this->_getWeather();
            $cache->save(serialize($this->_weather), $this->_cache_key, array(), 900);
        }
    }

    public function getTemperature()
    {
        if(isset($this->_weather['temp'])) {
            $unit = $this->getTemperatureUnit();
            return Mage::helper('weather')->calculateTemperatureFromKelvin($this->_weather['temp'], $unit);
        }
        return '';
    }

    public function getTemperatureUnit()
    {
        if(is_null($this->_temp_unit)) {
            $this->_temp_unit = Mage::getStoreConfig(self::XML_PATH_TEMP_UNIT);
        }
        return $this->_temp_unit;
    }

    public function getWind()
    {
        if(isset($this->_weather['wind'])) {
            $unit = $this->getWindUnit();
            return Mage::helper('weather')->calculateSpeedFromMps($this->_weather['wind'], $unit);
        }
        return '';
    }

    public function getWindUnit()
    {
        if(is_null($this->_wind_unit)) {
            $this->_wind_unit = Mage::getStoreConfig(self::XML_PATH_SPEED_UNI);
        }
        return $this->_wind_unit;
    }

    public function getLocation()
    {
        $location = Mage::getStoreConfig(self::XML_PATH_LOCATION);
        if(!$location) {
            $location = isset($this->_weather['location']) ? $this->_weather['location'] : '';
        }
        return $location;
    }

    public function getWeatherDescription()
    {
        return isset($this->_weather['desc']) ? Mage::helper('weather')->__($this->_weather['desc']) : '';
    }

    public function getWeatherIcon()
    {
        return isset($this->_weather['icon']) ? 'images/weather/' . $this->_weather['icon'] . '.png' : '';
    }

    public function getDate()
    {
        $date = isset($this->_weather['date']) ? $this->_weather['date']->setTimeZone(
                Mage::getStoreConfig(Mage_Core_Model_Locale::XML_PATH_DEFAULT_TIMEZONE)
        ) : new Zend_Date();
        return $date;
    }

    protected function _getWeather()
    {
        $weather = array();
        try{
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
            if(isset($list[0])) {
                $weather['temp'] = floatval($list[0]->main->temp);
                $weather['wind'] = floatval($list[0]->wind->speed);
                $weather['location'] = htmlspecialchars($list[0]->name);
                $weather['date'] = new Zend_Date($list[0]->dt, Zend_Date::TIMESTAMP, new Zend_Locale());
                if(isset($list[0]->weather[0])) {
                    $weather['desc'] = htmlspecialchars($list[0]->weather[0]->description);
                    $weather['icon'] = htmlspecialchars($list[0]->weather[0]->icon);
                }
            }
        } catch (Exception $e) {}
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