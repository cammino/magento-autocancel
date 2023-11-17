<?php
class  Cammino_Autocancel_Model_Source_Methods
{
    public function toOptionArray()
    {
        $allAvailablePaymentMethods = Mage::getModel('payment/config')->getAllMethods();
        $methods = [];
        foreach ($allAvailablePaymentMethods as $method) {
            $paymentTitle = Mage::getStoreConfig('payment/'.$method->getId().'/title');
            $methods[] = ["value"=>$method->getId(), "label" => $paymentTitle];
        }

        return $methods;
    }
}
