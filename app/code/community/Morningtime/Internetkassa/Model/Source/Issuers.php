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

class Morningtime_Internetkassa_Model_Source_Issuers
{
	public function toOptionArray()
    {
		return array(
			array('value' => 'RABO', 'label' => Mage::helper('internetkassa')->__('Rabo Internetkassa')),
			array('value' => 'ABNAMRO', 'label' => Mage::helper('internetkassa')->__('ABN AMRO Internetkassa')),
			array('value' => 'TWYP', 'label' => Mage::helper('internetkassa')->__('ING Bank (The Way You Pay)')),
			array('value' => 'NEOS', 'label' => Mage::helper('internetkassa')->__('Fortis Bank (NEOS Solutions)')),
			array('value' => 'OGONE', 'label' => Mage::helper('internetkassa')->__('Ogone')),
		);

	}
}
