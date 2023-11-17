<?php
class  Cammino_Autocancel_Model_Source_Methods
{
    public function toOptionArray()
    {
        $allActivePaymentMethods = Mage::getModel('payment/config')->getActiveMethods();
        $methods = [];
        foreach ($allActivePaymentMethods as $method) {
            Mage::log($method, null, 'autocancel.log');
        }
        
        $methods = array(
            array("value" => "", "label" => ""),
            array("value" => "kg", "label" => "kilogramas"),
            array("value" => "g", "label" => "gramas"),
        );

        return $methods;
    }
}
