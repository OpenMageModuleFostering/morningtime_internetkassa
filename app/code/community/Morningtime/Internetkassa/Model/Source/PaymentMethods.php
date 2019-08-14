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

class Morningtime_Internetkassa_Model_Source_PaymentMethods
{

	public function toOptionArray(){

		$list = Mage::getModel('internetkassa/source_paymentMethodsList')->getPMList();

		for ($i = 0; $i < sizeof($list); $i++) {
			  $pm = $list[$i];
              $pmArrayOption[] = array('value' => $pm->getPmName(), 'label' => $pm->getPmName());
        }

		return $pmArrayOption;
	}
	
}
