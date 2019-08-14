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

class Morningtime_Internetkassa_Model_Source_Currencies
{

	public function toOptionArray()
    {

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
			array('value' => 'GBP', 'label' => Mage::helper('internetkassa')->__('Pound Sterling')),
			array('value' => 'EUR', 'label' => Mage::helper('internetkassa')->__('Euro')),
			array('value' => 'HKD', 'label' => Mage::helper('internetkassa')->__('Hong Kong Dollar')),
			array('value' => 'HRK', 'label' => Mage::helper('internetkassa')->__('Croatian Kuna')),
			array('value' => 'USD', 'label' => Mage::helper('internetkassa')->__('US Dollar')),
		);

	}
}
