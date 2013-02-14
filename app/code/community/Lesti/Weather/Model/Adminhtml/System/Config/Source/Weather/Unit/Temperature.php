<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 12.02.13
 * Time: 16:21
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Model_Adminhtml_System_Config_Source_Weather_Unit_Temperature
{
    public function toOptionArray()
    {
        return array(
            array('value' => Lesti_Weather_Model_Weather_Temperature::KELVIN,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Temperature::KELVIN)),
            array('value' => Lesti_Weather_Model_Weather_Temperature::CELSIUS,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Temperature::CELSIUS)),
            array('value' => Lesti_Weather_Model_Weather_Temperature::FAHRENHEI,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Temperature::FAHRENHEI)),
            array('value' => Lesti_Weather_Model_Weather_Temperature::RANKINE,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Temperature::RANKINE))
        );
    }
}