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

class Morningtime_Internetkassa_Model_Source_PaymentMethod extends Varien_Object
{

	protected $_pmName;
	protected $_pmValue;
	protected $_pmBrand;
	protected $_pmUrlLogo;
	protected $_pmFamily;
	protected $_isActive;

	public function __construct()
	{
		parent::__construct();
	}

	public function __PaymentMethod(
		$pmName, $pmValue, $pmBrand, $pmUrlLogo,
		$pmFamily,	$isActive
	){

		$this->_pmName 		= $pmName;
		$this->_pmValue 	= $pmValue;
		$this->_pmBrand 	= $pmBrand;
		$this->_pmUrlLogo 	= $pmUrlLogo;
		$this->_pmFamily	= $pmFamily;
		$this->_isActive	= $isActive;

	}

	// getters
	public function getPmName(){
		return $this->_pmName;
	}

	public function getPmValue(){
		return $this->_pmValue;
	}

	public function getPmBrand(){
		return $this->_pmBrand;
	}

	public function getPmUrlLogo(){
		return $this->_pmUrlLogo;
	}

	public function getPmFamily(){
		return $this->_pmFamily;
	}

	public function isActive(){
		return $this->_isActive;
	}

	// setters
	public function setPmName($pmName){
		$this->_pmName = $pmName;
	}

	public function setPmValue($pmValue){
		$this->_pmValue = $pmValue;
	}

	public function setPmBrand($pmBrand){
		$this->_pmBrand = $pmBrand;
	}

	public function setPmUrlLogo($pmUrlLogo){
		$this->_pmUrlLogo = $pmUrlLogo;
	}

	public function setPmFamily($pmFamily){
		$this->_pmFamily = $pmFamily;
	}

	public function setIsActive($isActive){
		$this->_isActive = $isActive;
	}

}
