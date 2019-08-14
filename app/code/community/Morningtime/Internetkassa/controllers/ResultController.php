<?php
/**
 * Morningtime Internetkassa extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Morningtime
 * @package    Morningtime_Internetkassa
 * @copyright  Copyright (c) 2009 Morningtime Internet, http://www.morningtime.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Morningtime_Internetkassa_ResultController extends Mage_Core_Controller_Front_Action
{
    /**
     * Get Checkout Singleton
     *
     * @return Mage_Checkout_Model_Session
     */
    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }
	
    /**
     * Order instance
     */
    protected $_order;
	protected $_internetkassaResponse = null;

	protected function _expireAjax()
    {
        if (!Mage::getSingleton('checkout/session')->getQuote()->hasItems()) {
            $this->getResponse()->setHeader('HTTP/1.1','403 Session Expired');
            exit();
        }
    }

    /**
     * Get singleton with internetkassa order transaction information
     *
     * @return Morningtime_Internetkassa_Model_Internetkassa
     */
    public function getInternetkassa()
    {
        return Mage::getSingleton('internetkassa/internetkassa');
    }

    /**
     *  Get order
     *
     *  @param    none
     *  @return	  Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        if ($this->_order == null) {
            $session = Mage::getSingleton('checkout/session');
            $this->_order = Mage::getModel('sales/order');
            $this->_order->loadByIncrementId($session->getLastRealOrderId());
        }
        return $this->_order;
    }

	/**
     * seting response after returning from internetkassa
     *
     * @param array $response
     * @return object $this
     */
    protected function setInternetkassaResponse($response)
    {
    	if (count($response)) {
            $this->_internetkassaResponse = $response;
        }
        return $this;
    }

    /**
    * Checking response and Internetkassa session variables
    *
    * @return unknown
    */
    protected function _checkResponse()
    {

        if (!$this->_internetkassaResponse) {
        	Mage::throwException($this->__('No HTML response! Missing POST/GET vars in return URL from payment processor.'));
            return false;
        }

        //check for valid response
        if ($this->getInternetkassa()->checkResponse($this->_internetkassaResponse)) {

        	$order = Mage::getModel('sales/order')
                ->loadByIncrementId($this->_internetkassaResponse['orderID']);

            $orderId = $order->getId();
            if(!isset($orderId)){
            	Mage::throwException($this->__('Order identifier is not valid!'));
            	return false;
            }

            // test the amount
            if(	$this->_internetkassaResponse['amount']*100 !=
            	round($order->getBaseGrandTotal(), 2)*100 ){
					Mage::throwException($this->__('Amount order is not valid!'));
            		return false;
            }

            // test the payment method
			$payment = $this->getInternetkassa()->getQuote()->getPayment();
			$ccType =  $payment->getCcType();

			$list = Mage::getModel('internetkassa/source_paymentMethodsList')->getPMList();
			$orderInternetkassaPM = "";
			$orderInternetkassaBrand = "";

			for ($i = 0; $i < sizeof($list); $i++) {
				  if($list[$i]->getPmName() == $ccType){
				  	$orderInternetkassaPM = $list[$i]->getPmValue();
					$orderInternetkassaBrand = $list[$i]->getPmBrand();
				  }
	        }

	        if($orderInternetkassaPM == null && $orderInternetkassaBrand == null && $ccType != "CB" ){
	        	Mage::throwException($this->__('No payment method found for this order!'));
            	return false;
	        }

	        if(	$orderInternetkassaPM != $this->_internetkassaResponse['PM'] ||
	        	($orderInternetkassaBrand != $this->_internetkassaResponse['BRAND'] && $ccType != "CB")){
	        	Mage::throwException($this->__('No payment method or brand not valid for this order!'));
            	return false;
	        }

	        // compute the feedback sha1 sign to compare it
	        $feedbackSign = strtoupper(sha1(
	        		$this->_internetkassaResponse['orderID'].
					$this->_internetkassaResponse['currency'].
					$this->_internetkassaResponse['amount'].
					$this->_internetkassaResponse['PM'].
					$this->_internetkassaResponse['ACCEPTANCE'].
					$this->_internetkassaResponse['STATUS'].
					$this->_internetkassaResponse['CARDNO'].
					$this->_internetkassaResponse['PAYID'].
					$this->_internetkassaResponse['NCERROR'].
					$this->_internetkassaResponse['BRAND'].
					$this->getInternetkassa()->getInternetkassaSHA1PASS()
	        ));

	        if($this->_internetkassaResponse['SHASIGN'] != $feedbackSign){
	        	Mage::throwException($this->__('Feedback signature (SHA1Sign) is not valid!'));
            	return false;
	        }

            return true;
        }

        return true;
    }

    /**
     * When a customer chooses Internetkassa Payment on Checkout/Payment page
     *
     */
	public function redirectAction()
	{
		$session = Mage::getSingleton('checkout/session');

		$order = $this->getOrder();

		if (!$order->getId()) {
			$this->norouteAction();
			return;
		}

		$order->addStatusToHistory(
			$order->getStatus(),
			$this->__('Customer was redirected to Internetkassa.')
		);
		$order->save();

		$this->getResponse()
			->setBody($this->getLayout()
				->createBlock('internetkassa/redirect')
				->setOrder($order)
				->toHtml());

    }

	/**
     * Transaction result: 1. cancelled
     * 
     * Payment cancelled by user: redirect back to checkout/cart
     * We do not reset the cart, allowing user to re-order
     */
    public function cancelAction()
    {
    	if ($this->getRequest()->isPost()) {
			$this->setInternetkassaResponse($this->getRequest()->getPost());
		} else if ($this->getRequest()->isGet()) {
			$this->setInternetkassaResponse($this->getRequest()->getParams());
		}

        $order = Mage::getModel('sales/order')
             ->loadByIncrementId($this->_internetkassaResponse['orderID']);

        $order->cancel();

        $order->addStatusToHistory($order->getStatus(),
        $this->__('Payment was canceled by customer.')
                . "<br />Status: " . $this->_internetkassaResponse['STATUS']
				. "<br />Error Code: " . $this->_internetkassaResponse['NCERROR']
            );
        $order->save();

        $session = $this->getCheckout();
		$session->addError($this->__('You cancelled the payment. Please try again.'));
        $this->_redirect('checkout/cart');
    }

	/**
     * Transaction result: 2. declined
     * 
     * Payment declined by processor: redirect back to checkout/cart
     * We do not reset the cart
     */
    public function declineAction()
    {
    	if ($this->getRequest()->isPost()) {
			$this->setInternetkassaResponse($this->getRequest()->getPost());
		} else if ($this->getRequest()->isGet()) {
			$this->setInternetkassaResponse($this->getRequest()->getParams());
		}

        $order = Mage::getModel('sales/order')
             ->loadByIncrementId($this->_internetkassaResponse['orderID']);

        $order->addStatusToHistory($order->getStatus(),
        $this->__('Payment was declined by processor.')
                . "<br />Status: " . $this->_internetkassaResponse['STATUS']
				. "<br />Error Code: " . $this->_internetkassaResponse['NCERROR']
            );
        $order->save();

        $session = $this->getCheckout();
		$session->addError($this->__('The payment processor declined your payment. Please try again.'));
        $this->_redirect('checkout/cart');
    }

	/**
     * Transaction result: 3. exception
     * 
     * An exception occurred at the processor
     * We have to reset the cart for precaution
     */
    public function exceptionAction()
    {
    	if ($this->getRequest()->isPost()) {
			$this->setInternetkassaResponse($this->getRequest()->getPost());
		} else if ($this->getRequest()->isGet()) {
			$this->setInternetkassaResponse($this->getRequest()->getParams());
		}

        $order = Mage::getModel('sales/order')
             ->loadByIncrementId($this->_internetkassaResponse['orderID']);

        $order->cancel();

        $order->addStatusToHistory($order->getStatus(),
        $this->__('There was an exception. Payment failed.')
                . "<br />Status: " . $this->_internetkassaResponse['STATUS']
				. "<br />Error Code: " . $this->_internetkassaResponse['NCERROR']
            );
        $order->save();

        $session = $this->getCheckout();
        $session->setQuoteId($session->getInternetkassaQuoteId(true));
        $session->getQuote()->setIsActive(false)->save();
        $session->unsInternetkassaQuoteId();
		$session->addError($this->__('There was an exception. Your order was cancelled. Please try again.'));
        $this->_redirect('checkout/cart');
    }

	/**
     * Transaction result: 4. success
     * 
     * Client has returned from processor successfully
     */
    public function successAction()
    {
    	if ($this->getRequest()->isPost()) {
			$this->setInternetkassaResponse($this->getRequest()->getPost());
		} else if ($this->getRequest()->isGet()) {
			$this->setInternetkassaResponse($this->getRequest()->getParams());
		}

        if ($this->_checkResponse()) {

            $order = Mage::getModel('sales/order');
            $order->loadByIncrementId($this->_internetkassaResponse['orderID']);

            if ($this->_internetkassaResponse['STATUS'] == '5' ||
            	$this->_internetkassaResponse['STATUS'] == '9' // status 9 is for direct sales...
            ) {
                $order->addStatusToHistory(
	                $order->getStatus(),
					$this->__('Customer successfully returned from Internetkassa.')
					. "\n<br>Payment Method:" .$this->_internetkassaResponse['PM']
					. "\n<br>Operator:" .$this->_internetkassaResponse['BRAND']
					. "\n<br>Card No:" . $this->_internetkassaResponse['CARDNO']
					. "\n<br>TransactionId:" . $this->_internetkassaResponse['PAYID']
					."\n<br>\n<br>Operator Code :" . $this->_internetkassaResponse['ACCEPTANCE']
					."\n<br>\n<br>Error Code:" . $this->_internetkassaResponse['NCERROR']
	          	);

                if ($order->canInvoice()) {
                    $invoice = $order->prepareInvoice();
                    $invoice->register()->capture();
                    Mage::getModel('core/resource_transaction')
                        ->addObject($invoice)
                        ->addObject($invoice->getOrder())
                        ->save();
                }

                $order->sendNewOrderEmail();
	            $order->save();

    	        $this->_redirect('checkout/onepage/success');
    	        return;

            } else {
                $order->cancel();
                $order->addStatusToHistory($order->getStatus(), $this->__('An unexpected error occurred.'));

			    $session = Mage::getSingleton('checkout/session');
			    $session->addError($this->__('An unexpected error occurred. Your order was cancelled. Please try again.'));
				$this->_redirect('checkout/cart');
    	        return;
            }
        } else {
            $this->norouteAction();
            return;
        }
    }

    /**
     * Post-payment processing
     * 
     * Imagine a customer does not properly redirect after paying
     * This function is called by the Internetkassa dashboard, to re-repeat the call
     */
    public function processAction() {

    	if ($this->getRequest()->isPost()) {
			$this->setInternetkassaResponse($this->getRequest()->getPost());
		} else if ($this->getRequest()->isGet()) {
			$this->setInternetkassaResponse($this->getRequest()->getParams());
		}

	    if ($this->_checkResponse()) {

            $order = Mage::getModel('sales/order');
            $order->loadByIncrementId($this->_internetkassaResponse['orderID']);

            if ($this->_internetkassaResponse['STATUS'] == '5' ||
            	$this->_internetkassaResponse['STATUS'] == '9'
            ) {
                $order->addStatusToHistory(
	                $order->getStatus(),
					$this->__('Automatic update: payment successful!')
					. "<br />Payment Method:" .$this->_internetkassaResponse['PM']
					. "<br />Operator:" .$this->_internetkassaResponse['BRAND']
					. "<br />Card No:" . $this->_internetkassaResponse['CARDNO']
					. "<br />TransactionId:" . $this->_internetkassaResponse['PAYID']
					. "<br />Status :" . $this->_internetkassaResponse['STATUS']
					. "<br />Operator Code :" . $this->_internetkassaResponse['ACCEPTANCE']
					. "<br />Error Code:" . $this->_internetkassaResponse['NCERROR']
	          	);

                if ($order->canInvoice()) {
                    $invoice = $order->prepareInvoice();
                    $invoice->register()->capture();
                    Mage::getModel('core/resource_transaction')
                        ->addObject($invoice)
                        ->addObject($invoice->getOrder())
                        ->save();
                }

                $order->sendNewOrderEmail();
	            $order->save();

	            $this->norouteAction();
    	        return;

            } else {
				/**
				 * All other response cancel the order
				 * but we save the status
				 */
                $order->cancel();
                $order->addStatusToHistory(
                	$order->getStatus(),
                	$this->__('Automatic update: customer was rejected by Internetkassa')
                	. "\n<br>\n<br>Status :" . $this->_internetkassaResponse['STATUS']
					. "\n<br>\n<br>Error Code:" . $this->_internetkassaResponse['NCERROR']
                );

                $this->norouteAction();
    	        return;
            }
        } else {
            $this->norouteAction();
            return;
        }
    }

    /**
     * Error action. If request params to Internetkassa has mistakes, 
     * i.e. SHA1Sign check failed
     */
    public function errorAction()
    {
    	if ($this->getRequest()->isGet()) {
			$this->setInternetkassaResponse($this->getRequest()->getParams());
		}

        $session = Mage::getSingleton('checkout/session');
        $errorMsg = $this->__('An unexpected error occurred. Payment failed.')
	        	. "<br />Status: " .$this->_internetkassaResponse['STATUS'];
		$session->addError($errorMsg);

        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId($this->_internetkassaResponse['orderID']);

        if (!$order->getId()) {
            $this->norouteAction();
            return;
        }
        if ($order instanceof Mage_Sales_Model_Order && $order->getId()) {
            $order->addStatusToHistory(
                $order->getStatus(),
                $this->__('Customer returned from Ogone with an error.') . $errorMsg
            );

            $order->save();
        }

        // $this->loadLayout();
        // $this->renderLayout();
        Mage::getSingleton('checkout/session')->unsLastRealOrderId();
        $this->_redirect('internetkassa/result/exception');
    }

}
