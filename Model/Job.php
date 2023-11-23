<?php

class Cammino_Autocancel_Model_Job
{
    public function autocancel()
    {
        if (!Mage::getStoreConfig('autocancel/general/active')) {
            return;
        }
        Mage::log('Rodando cancelamentos automáticos', null, 'autocancel.log');
        $expires_at = (!empty(Mage::getStoreConfig('autocancel/general/hours_to_expire'))) ? Mage::getStoreConfig('autocancel/general/hours_to_expire') : 3;
        Mage::log('Horas atualmente configuradas para expiração: ' . $expires_at, null, 'autocancel.log');
        $fromDate = date('Y-m-d H:i:s', strtotime('-' . $expires_at . 'hour'));
        Mage::log('Pegar pedidos a partir de: ' . $expires_at, null, 'autocancel.log');
        $selectedMethods = explode(',', Mage::getStoreConfig('autocancel/general/payment_methods'));
        foreach ($selectedMethods as $method) {
            Mage::log('Checando pedidos status pending e com o método: ' . $method, null, 'autocancel.log');
            $paymentCollection =  Mage::getModel('sales/order_payment')->getCollection()->addFieldToFilter('method', $method);
            foreach ($paymentCollection as $payment) {
                try {
                    $order =  Mage::getModel('sales/order')->load($payment->getId());
                    if (($order->getCreatedAt() < $fromDate) && ($order->getStatus() == 'pending')) {
                        Mage::log('ORDER COM CREATED AT MENOR QUE O FROM DATE E STATUS PENDING! ' . $order->getId(), null, 'autocancel.log');
                        if ($order->canCancel()) {
                            $comment = "Pedido cancelado automaticamente por falta de pagamento antes do prazo de expiração.";
                            $order->addStatusHistoryComment($comment, false);
                            $order->setIsCustomerNotified(true);
                            $order->cancel();
                            $order->save();
                            Mage::log('order cancelada!!! ' . $order->getIncrementId(), null, 'autocancel.log');
                            Mage::log('data da criação da order: ' . $order->getCreatedAt(), null, 'autocancel.log');
                            Mage::log('data de comparação: ' . $fromDate, null, 'autocancel.log');
                        }
                    }
                } catch (Exception $e) {
                    Mage::log('error canceling order: ' . $payment->getId(), null, 'autocancel.log');
                    Mage::log($e->getMessage(), null, 'autocancel.log');
                }
            }
        }
    }
}
