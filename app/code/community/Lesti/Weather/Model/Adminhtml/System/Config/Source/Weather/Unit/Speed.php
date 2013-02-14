<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gordon
 * Date: 12.02.13
 * Time: 16:22
 * To change this template use File | Settings | File Templates.
 */
class Lesti_Weather_Model_Adminhtml_System_Config_Source_Weather_Unit_Speed
{
    public function toOptionArray()
    {
        return array(
            array('value' => Lesti_Weather_Model_Weather_Speed::METER_PER_SECOND,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Speed::METER_PER_SECOND)),
            array('value' => Lesti_Weather_Model_Weather_Speed::MILES_PER_HOUR,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Speed::MILES_PER_HOUR)),
            array('value' => Lesti_Weather_Model_Weather_Speed::KILOMETERS_PER_HOUR,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Speed::KILOMETERS_PER_HOUR)),
            array('value' => Lesti_Weather_Model_Weather_Speed::KNOT,
                'label' => Mage::helper('weather')->__(Lesti_Weather_Model_Weather_Speed::KNOT))
        );
    }
}