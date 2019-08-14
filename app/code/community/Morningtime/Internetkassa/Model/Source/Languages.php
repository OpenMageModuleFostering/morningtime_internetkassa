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

class Morningtime_Internetkassa_Model_Source_Languages
{
	
	public function toOptionArray()
    {
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
}
