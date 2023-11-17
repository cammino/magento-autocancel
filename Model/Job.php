<?php

class Cammino_Autocancel_Model_Job
{
    public function autocancel()
    {
//        $expires_at = (!empty(Mage::getStoreConfig('payment/pagarme_pix/hours_to_expire'))) ? Mage::getStoreConfig('payment/pagarme_pix/hours_to_expire') : 3;
//        $fromDate = date('Y-m-d H:i:s', strtotime('-' . $expires_at . 'hour'));
//        $paymentCollection =  Mage::getModel('sales/order_payment')->getCollection()->addFieldToFilter('method',"pagarme_pix");
//        foreach ($paymentCollection as $payment) {
//            try {
//                $order =  Mage::getModel('sales/order')->load($payment->getId());
//                if (($order->getCreatedAt() < $fromDate) && ($order->getStatus() == 'pending')) {
//                    if ($order->canCancel()) {
//                        $comment = "Pedido cancelado automaticamente por falta de pagamento antes do prazo de expiração.";
//                        $order->addStatusHistoryComment($comment, false);
//                        $order->setIsCustomerNotified(true);
//                        $order->cancel();
//                        $order->save();
//                        Mage::log('order cancelada: ' . $order->getIncrementId(), null, 'cancel_pagarme_pix.log');
//                        Mage::log('data da criação da order: ' . $order->getCreatedAt(), null, 'cancel_pagarme_pix.log');
//                        Mage::log('data de comparação: ' . $fromDate, null, 'cancel_pagarme_pix.log');
//                    }
//                }
//            } catch (Exception $e) {
//                Mage::log('error canceling order: ' . $payment->getId(), null, 'cancel_pagarme_pix.log');
//                Mage::log($e->getMessage(), null, 'cancel_pagarme_pix.log');
//            }
//        }
    }
}
