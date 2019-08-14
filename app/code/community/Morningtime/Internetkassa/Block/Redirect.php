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

class Morningtime_Internetkassa_Block_Redirect extends Mage_Core_Block_Abstract
{
	protected function _toHtml()
	{
		$standard = Mage::getModel('internetkassa/internetkassa');
        $form = new Varien_Data_Form();
        $form->setAction($standard->getInternetkassaUrl())
            ->setId('internetkassa_payment_checkout')
            ->setName('internetkassa_payment_checkout')
            ->setMethod('POST')
            ->setUseContainer(true);

		$form = $standard->addInternetkassaFields($form);

        $formHTML = $form->toHtml();

        $html = '<html><body>';
        $html.= $this->__('You will be redirected to the Internetkassa in a few seconds.');
		$html.= $formHTML;
        $html.= '<script type="text/javascript">document.getElementById("internetkassa_payment_checkout").submit();</script>';
        $html.= '</body></html>';

		return $html;
    }
}
