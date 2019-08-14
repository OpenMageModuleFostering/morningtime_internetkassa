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

class Morningtime_Internetkassa_Helper_ViewerList extends Mage_Core_Helper_Abstract
{
	
	public function getPMList(){
		
		$pmList = array();
		// Cards: General
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('AIRPLUS')
									->setPmValue('CreditCard')
									->setPmBrand('AIRPLUS')
									->setPmUrlLogo('AIRPLUS_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('American Express')
									->setPmValue('CreditCard')
									->setPmBrand('American Express')
									->setPmUrlLogo('American Express_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Aurora')
									->setPmValue('CreditCard')
									->setPmBrand('Aurora')
									->setPmUrlLogo('Aurora_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Aurore')
									->setPmValue('CreditCard')
									->setPmBrand('Aurore')
									->setPmUrlLogo('Aurore_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Cofinoga')
									->setPmValue('CreditCard')
									->setPmBrand('Cofinoga')
									->setPmUrlLogo('Cofinoga_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Dankort')
									->setPmValue('CreditCard')
									->setPmBrand('Dankort')
									->setPmUrlLogo('Dankort_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Diners Club')
									->setPmValue('CreditCard')
									->setPmBrand('Diners Club')
									->setPmUrlLogo('Diners Club_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('JCB')
									->setPmValue('CreditCard')
									->setPmBrand('JCB')
									->setPmUrlLogo('JCB_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('MaestroUK')
									->setPmValue('CreditCard')
									->setPmBrand('MaestroUK')
									->setPmUrlLogo('MaestroUK_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Eurocard')
									->setPmValue('CreditCard')
									->setPmBrand('Eurocard')
									->setPmUrlLogo('Eurocard_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Solo')
									->setPmValue('CreditCard')
									->setPmBrand('Solo')
									->setPmUrlLogo('Solo_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('UATP')
									->setPmValue('CreditCard')
									->setPmBrand('UATP')
									->setPmUrlLogo('UATP_choice.gif')
									->setPmFamily('Cards: General');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('VISA')
									->setPmValue('CreditCard')
									->setPmBrand('VISA')
									->setPmUrlLogo('VISA_choice.gif')
									->setPmFamily('Cards: General');
		
		// Cards: exceptions
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('BCMC')
									->setPmValue('CreditCard')
									->setPmBrand('BCMC')
									->setPmUrlLogo('BCMC_choice.gif')
									->setPmFamily('Cards: exceptions');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Maestro')
									->setPmValue('CreditCard')
									->setPmBrand('Maestro')
									->setPmUrlLogo('Maestro_choice.gif')
									->setPmFamily('Cards: exceptions');
		
		// Cards: Online Credit 
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('NetReserve ')
									->setPmValue('CreditCard ')
									->setPmBrand('NetReserve ')
									->setPmUrlLogo('NetReserve_choice.gif')
									->setPmFamily('Cards: Online Credit ');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('UNEUROCOM ')
									->setPmValue('UNEUROCOM ')
									->setPmBrand('UNEUROCOM ')
									->setPmUrlLogo('UNEUROCOM_choice.gif')
									->setPmFamily('Cards: Online Credit ');

		
		// WebBanking
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('CBC Online')
									->setPmValue('CBC Online')
									->setPmBrand('CBC Online')
									->setPmUrlLogo('CBC Online_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('CENTEA Online')
									->setPmValue('CENTEA Online')
									->setPmBrand('CENTEA Online')
									->setPmUrlLogo('CENTEA Online_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('Dexia Direct Net')
									->setPmValue('Dexia Direct Net')
									->setPmBrand('Dexia Direct Net')
									->setPmUrlLogo('Dexia Direct Net_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('eDankort')
									->setPmValue('eDankort')
									->setPmBrand('eDankort')
									->setPmUrlLogo('eDankort_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('EPS')
									->setPmValue('EPS')
									->setPmBrand('EPS')
									->setPmUrlLogo('EPS_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('iDEAL')
									->setPmValue('iDEAL')
									->setPmBrand('iDEAL')
									->setPmUrlLogo('iDEAL_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('ING HomePay')
									->setPmValue('ING HomePay')
									->setPmBrand('ING HomePay')
									->setPmUrlLogo('ING HomePay_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('KBC Online')
									->setPmValue('KBC Online')
									->setPmBrand('KBC Online')
									->setPmUrlLogo('KBC Online_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('PostFinance Debit Direct')
									->setPmValue('PostFinance Debit Direct')
									->setPmBrand('PostFinance Debit Direct')
									->setPmUrlLogo('PostFinance Debit Direct_choice.gif')
									->setPmFamily('WebBanking');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
									->setPmName('PostFinance yellownet')
									->setPmValue('PostFinance yellownet')
									->setPmBrand('PostFinance yellownet')
									->setPmUrlLogo('PostFinance yellownet_choice.gif')
									->setPmFamily('WebBanking');

		// Direct Debits
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('Direct Debits DE')
											->setPmValue('Direct Debits DE')
											->setPmBrand('Direct Debits DE')
											->setPmUrlLogo('Direct Debits DE_choice.gif')
											->setPmFamily('Direct Debits');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('Direct Debits NL')
											->setPmValue('Direct Debits NL')
											->setPmBrand('Direct Debits NL')
											->setPmUrlLogo('Direct Debits NL_choice.gif')
											->setPmFamily('Direct Debits');
		
		// Offline payment
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('Acceptgiro ')
											->setPmValue('Acceptgiro ')
											->setPmBrand('Acceptgiro ')
											->setPmUrlLogo('Acceptgiro _choice.gif')
											->setPmFamily('Offline payment ');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('Bank transfer ')
											->setPmValue('Bank transfer ')
											->setPmBrand('Bank transfer ')
											->setPmUrlLogo('Bank transfer _choice.gif')
											->setPmFamily('Offline payment ');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('Payment on Delivery ')
											->setPmValue('Payment on Delivery ')
											->setPmBrand('Payment on Delivery ')
											->setPmUrlLogo('Payment on Delivery _choice.gif')
											->setPmFamily('Offline payment ');

		
		// Micro
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('MiniTix')
											->setPmValue('MiniTix')
											->setPmBrand('MiniTix')
											->setPmUrlLogo('MiniTix_choice.gif')
											->setPmFamily('Micro');
		
		// Mobile
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('TUNZ')
											->setPmValue('TUNZ')
											->setPmBrand('TUNZ')
											->setPmUrlLogo('TUNZ_choice.gif')
											->setPmFamily('Mobile');
		
		// Others
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('PAYPAL')
											->setPmValue('PAYPAL')
											->setPmBrand('PAYPAL')
											->setPmUrlLogo('PAYPAL_choice.gif')
											->setPmFamily('Others');
		$pmList[] = Mage::getModel('internetkassa/paymentMethod')
											->setPmName('Wallie')
											->setPmValue('Wallie')
											->setPmBrand('Wallie')
											->setPmUrlLogo('Wallie_choice.gif')
											->setPmFamily('Others');

		return $pmList;
	}
	
	public function getLangList(){
		
		return array(
			array('value' => 'en_US', 'label' => Mage::helper('internetkassa')->__('English (default)')),
			array('value' => 'fr_FR', 'label' => Mage::helper('internetkassa')->__('French')),
			array('value' => 'nl_NL', 'label' => Mage::helper('internetkassa')->__('Dutch')),
			array('value' => 'nl_BE', 'label' => Mage::helper('internetkassa')->__('Flemish')),
			array('value' => 'it_IT', 'label' => Mage::helper('internetkassa')->__('Italian')),
			array('value' => 'de_DE', 'label' => Mage::helper('internetkassa')->__('German')),
			array('value' => 'es_ES', 'label' => Mage::helper('internetkassa')->__('Spanish')),
			array('value' => 'no_NO', 'label' => Mage::helper('internetkassa')->__('Norwegian')),
			array('value' => 'tr_TR', 'label' => Mage::helper('internetkassa')->__('Turkish')),
		);
		
	}
	
	public function getCurrencyList(){
		
		return array(
		
			array('value' => 'AED', 'label' => Mage::helper('internetkassa')->__('United Arab Emirates Dirham')),
			array('value' => 'AUD', 'label' => Mage::helper('internetkassa')->__('Australian Dollar')),
			array('value' => 'CAD', 'label' => Mage::helper('internetkassa')->__('Canadian Dollar')),
			array('value' => 'CHF', 'label' => Mage::helper('internetkassa')->__('Swiss Franc')),
			array('value' => 'CNY', 'label' => Mage::helper('internetkassa')->__('Chinese Yuan Renminbi')),
			array('value' => 'CYP', 'label' => Mage::helper('internetkassa')->__('Cyprus Pound')),
			array('value' => 'CZK', 'label' => Mage::helper('internetkassa')->__('Czech koruna')),
			array('value' => 'DKK', 'label' => Mage::helper('internetkassa')->__('Danish Krone')),
			array('value' => 'EEK', 'label' => Mage::helper('internetkassa')->__('Estonian Kroon')),
			array('value' => 'GBP', 'label' => Mage::helper('internetkassa')->__('Pound sterling')),
			array('value' => 'EUR', 'label' => Mage::helper('internetkassa')->__('Euro')),
			array('value' => 'HKD', 'label' => Mage::helper('internetkassa')->__('Hong Kong Dollar')),
			array('value' => 'HRK', 'label' => Mage::helper('internetkassa')->__('Croatian Kuna')),
			array('value' => 'USD', 'label' => Mage::helper('internetkassa')->__('US Dollar')),
		);
		
	}
}
