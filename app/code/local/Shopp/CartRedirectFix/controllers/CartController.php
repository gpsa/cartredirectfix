<?php
# Controllers are not autoloaded so we will have to do it manually:
require_once 'Mage/Checkout/controllers/CartController.php';

/*
 * Data de criação: 12/03/2016 11:25:47
 *
 * Desenvolvido por Guilherme Alves.
 */

/**
 * Description of CartController
 *
 * @author Guilherme P. S. Alves <guilhermepsa@gmail.com>
 */
class Shopp_CartRedirectFix_CartController extends Mage_Checkout_CartController
{

    /**
     * Delete shoping cart item action
     */
    public function deleteAction()
    {
        if ($this->_validateFormKey()) {
            $id = (int) $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $this->_getCart()->removeItem($id)
                        ->save();
                } catch (Exception $e) {
                    $this->_getSession()->addError($this->__('Cannot remove the item.'));
                    Mage::logException($e);
                }
            }
        } else {
            $this->_getSession()->addError($this->__('Cannot remove the item.'));
        }

        $this->_redirectReferer(Mage::helper('checkout/cart')->getCartUrl());
    }
}