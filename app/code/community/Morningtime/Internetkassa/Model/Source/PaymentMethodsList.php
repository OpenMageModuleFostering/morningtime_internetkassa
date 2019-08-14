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

class Morningtime_Internetkassa_Model_Source_PaymentMethodsList
{

	public function getPMList(){

		$pmList = array();

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Cards: Commons ===','Cards: exceptions',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('CB','CreditCard',
				'','Carte%20bleue_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('AIRPLUS','CreditCard',
				'AIRPLUS','AIRPLUS_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('American Express','CreditCard',
							 'American Express','American Express_choice.gif',
							 'Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Aurora','CreditCard',
							'Aurora','Aurora_choice.gif','Cards: General'
							, false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Aurore','CreditCard',
						'Aurore','Aurore_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Cofinoga','CreditCard',
				'Cofinoga','Cofinoga_choice.gif','Cards: General', false);
		$pmList[] = $pm;
		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Dankort','CreditCard',
							'Dankort','Dankort_choice.gif',
							'Cards: General', false);
		$pmList[] = $pm;
		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Diners Club','CreditCard',
		 'Diners Club','Diners Club_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('JCB','CreditCard',
		 'JCB','JCB_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('MaestroUK','CreditCard',
		 'MaestroUK','MaestroUK_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('MasterCard','CreditCard',
		 'MasterCard','Eurocard_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Solo','CreditCard',
		 'Solo','Solo_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('UATP','CreditCard',
		 'UATP','UATP_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('VISA','CreditCard',
				 'VISA','VISA_choice.gif','Cards: General', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Cards: exceptions ===','Cards: exceptions',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('BCMC','CreditCard',
				 'BCMC','BCMC_choice.gif','Cards: exceptions', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Maestro','CreditCard',
				 'Maestro','Maestro_choice.gif',
				 'Cards: exceptions', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Cards: Online Credit ===','Cards: Online Credit',
				 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('NetReserve','CreditCard',
				 'NetReserve','NetReserve_choice.gif',
				 'Cards: Online Credit', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('UNEUROCOM','UNEUROCOM',
				 'UNEUROCOM','UNEUROCOM_choice.gif',
				 'Cards: Online Credit', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== WebBanking ===','WebBanking',
				 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('CBC Online','CBC Online',
				 'CBC Online','CBC Online_choice.gif',
				 'WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('CENTEA Online','CENTEA Online',
				 'CENTEA Online','CENTEA Online_choice.gif',
				 'WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Dexia Direct Net','Dexia Direct Net',
				 'Dexia Direct Net','Dexia Direct Net_choice.gif',
				 'WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('eDankort','eDankort',
				 'eDankort','eDankort_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('EPS','EPS',
				 'EPS','EPS_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('iDEAL','iDEAL',
				 'iDEAL','iDEAL_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('ING HomePay','ING HomePay',
				 'ING HomePay','ING HomePay_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('KBC Online','KBC Online',
		 'KBC Online','KBC Online_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('PostFinance Debit Direct','PostFinance Debit Direct',
		 'PostFinance Debit Direct','PostFinance Debit Direct_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('PostFinance yellownet','PostFinance yellownet',
		 'PostFinance yellownet','PostFinance yellownet_choice.gif','WebBanking', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Direct Debit ===','Direct Debits',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Direct Debits DE','Direct Debits DE',
		 'Direct Debits DE','Direct Debits DE_choice.gif','Direct Debits', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Direct Debits NL','Direct Debits NL',
		 'Direct Debits NL','Direct Debits NL_choice.gif','Direct Debits', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Offline payment ===','Offline payment',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Acceptgiro','Acceptgiro',
		 'Acceptgiro','Acceptgiro_choice.gif','Offline payment', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Bank transfer','Bank transfer',
		 'Bank transfer','Bank transfer_choice.gif','Offline payment', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Payment on Delivery','Payment on Delivery',
		 'Payment on Delivery','Payment on Delivery_choice.gif','Offline payment', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Micro ===','Micro',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('MiniTix','MiniTix',
		 'MiniTix','MiniTix_choice.gif','Micro', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Mobile ===','Mobile',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('TUNZ','TUNZ',
		 'TUNZ','TUNZ_choice.gif','Mobile', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('=== Others ===','Others',
		 '','_choice.gif','', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('PAYPAL','PAYPAL',
		 'PAYPAL','PAYPAL_choice.gif','Others', false);
		$pmList[] = $pm;

		$pm = Mage::getModel('internetkassa/source_paymentMethod');
		$pm->__PaymentMethod('Wallie','Wallie',
		 'Wallie','Wallie_choice.gif','Others', false);
		$pmList[] = $pm;

		return $pmList;
	}
}
