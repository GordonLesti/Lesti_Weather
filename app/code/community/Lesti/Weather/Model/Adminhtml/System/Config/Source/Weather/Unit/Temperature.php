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
            array('value' => Lesti_Weather_Model_Weather_Temperature::KELVIN, 'label' => Mage::helper('weather')->__('Kelvin')),
            array('value' => Lesti_Weather_Model_Weather_Temperature::GRAD_CELSIUS, 'label' => Mage::helper('weather')->__('Grad Celsius')),
            array('value' => Lesti_Weather_Model_Weather_Temperature::GRAD_FAHRENHEI, 'label' => Mage::helper('weather')->__('Grad Fahrenheit')),
            array('value' => Lesti_Weather_Model_Weather_Temperature::GRAD_RANKINE, 'label' => Mage::helper('weather')->__('Grad Rankine')),
            array('value' => Lesti_Weather_Model_Weather_Temperature::GRAD_REAUMUR, 'label' => Mage::helper('weather')->__('Grad Reaumur'))
        );
    }
}