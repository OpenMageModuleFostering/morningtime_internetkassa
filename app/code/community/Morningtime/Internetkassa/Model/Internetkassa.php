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

class Morningtime_Internetkassa_Model_Internetkassa extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'internetkassa';

    protected $_formBlockType = 'internetkassa/form';
    protected $_infoBlockType = 'internetkassa/info';

	/*
	 * Switch the payment provider
	 */
	public function getIssuerUrls() {
		$issuer = Mage::getStoreConfig('payment/internetkassa/issuer');

		switch($issuer) {
			case "RABO":
				return array("prod" => "https://i-kassa.rabobank.nl/ncol/prod/orderstandard.asp",
							 "test" => "https://i-kassa.rabobank.nl/ncol/test/orderstandard.asp");
				break;

			case "ABNAMRO":
				return array("prod" => "https://internetkassa.abnamro.nl/ncol/prod/orderstandard.asp",
							 "test" => "https://internetkassa.abnamro.nl/ncol/test/orderstandard.asp");
				break;
				
			case "NEOS":
				return array("prod" => "https://www.secure.neos-solution.com/ncol/prod/orderstandard.asp",
							 "test" => "https://www.secure.neos-solution.com/ncol/test/orderstandard.asp");
				break;
				
			case "TWYP":
				return array("prod" => "https://twyp.secure-ing.com/ncol/prod/orderstandard.asp",
							 "test" => "https://twyp.secure-ing.com/ncol/test/orderstandard.asp");
				break;

			case "OGONE":
				return array("prod" => "https://secure.ogone.com/ncol/prod/orderstandard.asp",
							 "test" => "https://secure.ogone.com/ncol/test/orderstandard.asp");
				break;

		}
		
	}
	
    const TEST_MERCHANT_kEY = '58 6d fc 9c 34 91 9b 86 3f fd 64 63 c9 13 4a 26 ba 29 74 1e c7 e9 80 79';
    const TEST_CODE_SIRET = '00000000000001';
    const TEST_CODE_SITE = '001';

    protected $_customer;
    protected $_checkout;
    protected $_quote;
    protected $_order;
    protected $_allowCurrencyCodes;
    protected $_allowedParamToSend;

    /**
     * Availability options
     */
    protected $_isGateway               = true;
    protected $_canAuthorize            = true;
    protected $_canCapture              = true;
    protected $_canCapturePartial       = false;
    protected $_canRefund               = false;
    protected $_canVoid                 = false;
    protected $_canUseInternal          = false;
    protected $_canUseCheckout          = true;
    protected $_canUseForMultishipping  = true;

	protected $moduleTitle;
	protected $moduleDebugMode;

	/**
	 * Internetkassa Settings
	 *
	 **/
	protected $internetkassa_PSPID;
	protected $internetkassa_SHA1PASS;

	protected $internetkassa_Currency;
	protected $internetkassa_Language;
	/*  Optional fields for design  */
	/* Static template page  */
	protected $internetkassa_TITLE; 			/*  Title for static template  */
	protected $internetkassa_BGCOLOR; 			/*  Background color for static template */
	protected $internetkassa_TXTCOLOR; 			/*  Text color for static template */
	protected $internetkassa_TBLBGCOLOR; 		/*  Table background color for static template */
	protected $internetkassa_TBLTXTCOLOR; 		/*  Table text color for static template */
	protected $internetkassa_BUTTONBGCOLOR; 	/*  Button background color for static template */
	protected $internetkassa_BUTTONTXTCOLOR; 	/*  Button text color for static template */
	protected $internetkassa_FONTTYPE; 			/*  Font Type for static template: default = Verdana */
	protected $internetkassa_LOGO; 				/*  Logo filename for static template: send logo to support with your PSPID in the subject */
	/*  or dynamic template page  */
	protected $internetkassa_TP; 				/*  The full URL of the Template Page hosted on the merchant's site and containing the "payment string" eg: http://www.MyEcommerceSite.com/TemplatePage.htm or templateSTD3.htm  */
	/* Post-payment redirection  */
	protected $internetkassa_accepturl; 		/*  demo_accepturl.htm */
	protected $internetkassa_declineurl; 		/*  demo_declineurl.htm */
	protected $internetkassa_exceptionurl;		/*  demo_exceptionurl.htm */
	protected $internetkassa_cancelurl; 		/*  demo_cancelurl.htm */
	/*  Link to your website in case of standard confirmation page built by Internetkassa  */
	protected $internetkassa_homeurl;
	protected $internetkassa_catalogurl;
	/*  Other optional fields  */
	protected $internetkassa_CN; 				/*  Optional client name  */
	protected $internetkassa_EMAIL; 			/*  Optional client email */
	protected $internetkassa_PM; 				/*  Optional Payment Method : <EM>CreditCard, iDEAL, ING HomePay, KBC Online, CBC Online, DEXIA NetBanking</EM>  */
	protected $internetkassa_BRAND; 			/*  Optional, can be deduced from the card number */
	protected $internetkassa_SHASign;
	protected $internetkassa_Signature;
	protected $internetkassa_ownerZIP;
	protected $internetkassa_owneraddress;
	protected $internetkassa_ownercty;
	protected $internetkassa_Alias;
	protected $internetkassa_AliasUsage;
	protected $internetkassa_AliasOperationCOM;	/*  Optional order description */
	protected $internetkassa_COMPLUS;			/*  Optional additional info for post-payment feedback */
	protected $internetkassa_PARAMPLUS; 		/*  Optional params for post-payment feedback */
	protected $internetkassa_PARAMVAR; 			/*  Optional url Variable for post-payment feedback */
	protected $internetkassa_USERID; 			/*  Optional userid for account with User Manager. */
	protected $internetkassa_CreditCode; 		/*  Optional CreditCode for Cofinoga/NetReserve. */


	/* Getters */
	public function getTitle(){
		if($this->moduleTitle == null)
			$this->moduleTitle = Mage::getStoreConfig('payment/internetkassa/title');

		return $this->moduleTitle;
	}

	public function getDebugMode(){
		if($this->moduleDebugMode == null)
			$this->moduleDebugMode = Mage::getStoreConfig('payment/internetkassa/test');

		return $this->moduleDebugMode;
	}


	public function getInternetkassaPSPID(){

		if($this->internetkassa_PSPID == null)
			$this->internetkassa_PSPID = Mage::getStoreConfig('payment/internetkassa/PSPID');

		return $this->internetkassa_PSPID;
	}

	public function getInternetkassaSHA1PASS(){

		if($this->internetkassa_SHA1PASS == null)
			$this->internetkassa_SHA1PASS = Mage::getStoreConfig('payment/internetkassa/SHA1PASS');

		return $this->internetkassa_SHA1PASS;
	}

	public function getInternetkassaCurrency(){

		if($this->internetkassa_Currency == null)
			$this->internetkassa_Currency = Mage::getStoreConfig('payment/internetkassa/Currency');

		return $this->internetkassa_Currency;
	}

	public function getInternetkassaLanguage(){
		if($this->internetkassa_Language == null)
			$this->internetkassa_Language = Mage::getStoreConfig('payment/internetkassa/Language');

		return $this->internetkassa_Language;
	}

	public function getInternetkassaTITLE(){
		if($this->internetkassa_TITLE == null)
			$this->internetkassa_TITLE = Mage::getStoreConfig('payment/internetkassa/TITLE');

		return $this->internetkassa_TITLE;
	}

	public function getInternetkassaBGCOLOR(){
		if($this->internetkassa_BGCOLOR == null)
			$this->internetkassa_BGCOLOR = Mage::getStoreConfig('payment/internetkassa/BGCOLOR');

		return $this->internetkassa_BGCOLOR;
	}

	public function getInternetkassaTXTCOLOR(){
		if($this->internetkassa_TXTCOLOR == null)
			$this->internetkassa_TXTCOLOR = Mage::getStoreConfig('payment/internetkassa/TXTCOLOR');

		return $this->internetkassa_TXTCOLOR;
	}

	public function getInternetkassaTBLBGCOLOR(){
		if($this->internetkassa_TBLBGCOLOR == null)
			$this->internetkassa_TBLBGCOLOR = Mage::getStoreConfig('payment/internetkassa/TBLBGCOLOR');

		return $this->internetkassa_TBLBGCOLOR;
	}

	public function getInternetkassaTBLTXTCOLOR(){
		if($this->internetkassa_TBLTXTCOLOR == null)
			$this->internetkassa_TBLTXTCOLOR = Mage::getStoreConfig('payment/internetkassa/TBLTXTCOLOR');

		return $this->internetkassa_TBLTXTCOLOR;
	}

	public function getInternetkassaBUTTONBGCOLOR(){
		if($this->internetkassa_BUTTONBGCOLOR == null)
			$this->internetkassa_BUTTONBGCOLOR = Mage::getStoreConfig('payment/internetkassa/BUTTONBGCOLOR');

		return $this->internetkassa_BUTTONBGCOLOR;
	}

	public function getInternetkassaBUTTONTXTCOLOR(){
		if($this->internetkassa_BUTTONTXTCOLOR == null)
			$this->internetkassa_BUTTONTXTCOLOR = Mage::getStoreConfig('payment/internetkassa/BUTTONTXTCOLOR');

		return $this->internetkassa_BUTTONTXTCOLOR;
	}

	public function getInternetkassaFONTTYPE(){
		if($this->internetkassa_FONTTYPE == null)
			$this->internetkassa_FONTTYPE = Mage::getStoreConfig('payment/internetkassa/FONTTYPE');

		return $this->internetkassa_FONTTYPE;
	}

	public function getInternetkassaLOGO(){
		if($this->internetkassa_LOGO == null)
			$this->internetkassa_LOGO = Mage::getStoreConfig('payment/internetkassa/LOGO');

		return $this->internetkassa_LOGO;
	}

	public function getInternetkassaTP(){
		if($this->internetkassa_TP == null)
			$this->internetkassa_TP = Mage::getStoreConfig('payment/internetkassa/TP');

		return $this->internetkassa_TP;
	}

	public function getInternetkassaAcceptUrl(){
		if($this->internetkassa_accepturl == null)
			$this->internetkassa_accepturl = Mage::getStoreConfig('payment/internetkassa/accepturl');

		return $this->internetkassa_accepturl;
	}

	public function getInternetkassaDeclineUrl(){
		if($this->internetkassa_declineurl == null)
			$this->internetkassa_declineurl = Mage::getStoreConfig('payment/internetkassa/declineurl');

		return $this->internetkassa_declineurl;
	}

	public function getInternetkassaExceptionUrl(){
		if($this->internetkassa_exceptionurl == null)
			$this->internetkassa_exceptionurl = Mage::getStoreConfig('payment/internetkassa/exceptionurl');

		return $this->internetkassa_exceptionurl;
	}

	public function getInternetkassaCancelUrl(){
		if($this->internetkassa_cancelurl == null)
			$this->internetkassa_cancelurl = Mage::getStoreConfig('payment/internetkassa/cancelurl');

		return $this->internetkassa_cancelurl;
	}

	public function getInternetkassaHomeUrl(){
		if($this->internetkassa_homeurl == null)
			$this->internetkassa_homeurl = Mage::getStoreConfig('payment/internetkassa/homeurl');

		return $this->internetkassa_homeurl;
	}

	public function getInternetkassaCatalogUrl(){
		if($this->internetkassa_catalogurl == null)
			$this->internetkassa_catalogurl = Mage::getStoreConfig('payment/internetkassa/catalogurl');

		return $this->internetkassa_catalogurl;
	}

	public function getInternetkassaCN(){
		if($this->internetkassa_CN == null)
			$this->internetkassa_CN = Mage::getStoreConfig('payment/internetkassa/CN');

		return $this->internetkassa_CN;
	}

	public function getInternetkassaEMAIL(){
		if($this->internetkassa_EMAIL == null)
			$this->internetkassa_EMAIL = Mage::getStoreConfig('payment/internetkassa/EMAIL');

		return $this->internetkassa_EMAIL;
	}

	public function getInternetkassaPM(){
		if($this->internetkassa_PM == null)
			$this->internetkassa_PM = Mage::getStoreConfig('payment/internetkassa/PM');

		return $this->internetkassa_PM;
	}

	public function getInternetkassaBRAND(){
		if($this->internetkassa_BRAND == null)
			$this->internetkassa_BRAND = Mage::getStoreConfig('payment/internetkassa/BRAND');

		return $this->internetkassa_BRAND;
	}


	public function getInternetkassaSignature(){
		if($this->internetkassa_Signature == null)
			$this->internetkassa_Signature = Mage::getStoreConfig('payment/internetkassa/Signature');

		return $this->internetkassa_Signature;
	}

	public function getInternetkassaOwnerZIP(){
		if($this->internetkassa_ownerZIP == null)
			$this->internetkassa_ownerZIP = Mage::getStoreConfig('payment/internetkassa/ownerZIP');

		return $this->internetkassa_ownerZIP;
	}

	public function getInternetkassaOwnerAddress(){
		if($this->internetkassa_owneraddress == null)
			$this->internetkassa_owneraddress = Mage::getStoreConfig('payment/internetkassa/owneraddress');

		return $this->internetkassa_owneraddress;
	}

	public function getInternetkassaOwnerCty(){
		if($this->internetkassa_ownercty == null)
			$this->internetkassa_ownercty = Mage::getStoreConfig('payment/internetkassa/ownercty');

		return $this->internetkassa_ownercty;
	}

	public function getInternetkassaAlias(){
		if($this->internetkassa_Alias == null)
			$this->internetkassa_Alias = Mage::getStoreConfig('payment/internetkassa/Alias');

		return $this->internetkassa_Alias;
	}

	public function getInternetkassaAliasUsage(){
		if($this->internetkassa_AliasUsage == null)
			$this->internetkassa_AliasUsage = Mage::getStoreConfig('payment/internetkassa/AliasUsage');

		return $this->internetkassa_AliasUsage;
	}

	public function getInternetkassaAliasOperationCOM(){
		if($this->internetkassa_OperationCOM == null)
			$this->internetkassa_OperationCOM = Mage::getStoreConfig('payment/internetkassa/OperationCOM');

		return $this->internetkassa_OperationCOM;
	}

	public function getInternetkassaCOMPLUS(){
		if($this->internetkassa_COMPLUS == null)
			$this->internetkassa_COMPLUS = Mage::getStoreConfig('payment/internetkassa/COMPLUS');

		return $this->internetkassa_COMPLUS;
	}

	public function getInternetkassaPARAMPLUS(){
		if($this->internetkassa_PARAMPLUS == null)
			$this->internetkassa_PARAMPLUS = Mage::getStoreConfig('payment/internetkassa/PARAMPLUS');

		return $this->internetkassa_PARAMPLUS;
	}

	public function getInternetkassaPARAMVAR(){
		if($this->internetkassa_PARAMVAR == null)
			$this->internetkassa_PARAMVAR = Mage::getStoreConfig('payment/internetkassa/PARAMVAR');

		return $this->internetkassa_PARAMVAR;
	}

	public function getInternetkassaUSERID(){
		if($this->internetkassa_USERID == null)
			$this->internetkassa_USERID = Mage::getStoreConfig('payment/internetkassa/USERID');

		return $this->internetkassa_USERID;
	}

	public function getInternetkassaCreditCode(){
		if($this->internetkassa_CreditCode == null)
			$this->internetkassa_CreditCode = Mage::getStoreConfig('payment/internetkassa/CreditCode');

		return $this->internetkassa_CreditCode;
	}

	/**
	 * Return the url for the getaway
	 * @return
	 */
	public function getInternetkassaUrl(){
		
		$setIssuerUrls = $this->getIssuerUrls();
		
		if($this->getDebugMode())
			return $setIssuerUrls["test"];
		else
			return $setIssuerUrls["prod"];
	}

	 /**
     * Assign data to info model instance
     *
     * @param   mixed $data
     * @return  Mage_Internetkassa_Model_Method_Internetkassa
     */

	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        $info->setCcType($data->getCcType());

        return $this;
    }


   public function validate()
    {
    	$errorMsg = false;
		$info = $this->getInfoInstance();

		$ccType =  $info->getCcType();

    	if(empty($ccType)){
    		$errorMsg = $this->__('You have to choose a payment method!');
    	}

    	if($errorMsg){
            Mage::throwException($errorMsg);
        }

        return $this;
    }

	protected function getSuccessURL()
	{
		return Mage::getUrl('/internetkassa/result/success', array('_secure' => true));
	}

	protected function getErrorURL()
    {
        return Mage::getUrl('/internetkassa/result/error', array('_secure' => true));
    }

	/**
     * Capture payment
     *
     * @param   Varien_Object $orderPayment
     * @return  Mage_Payment_Model_Abstract
     */
    public function capture(Varien_Object $payment, $amount)
    {
        $payment->setStatus(self::STATUS_APPROVED)
            ->setLastTransId($this->getTransactionId());

        return $this;
    }


	/**
	 * add all needed fields for internetkassa
	 * @return
	 * @param $forms Object
	 */
	public function addInternetkassaFields($form){

		// get payment mode
		$payment = $this->getQuote()->getPayment();

		$ccType =  $payment->getCcType();

		$list = Mage::getModel('internetkassa/source_paymentMethodsList')->getPMList();
		for ($i = 0; $i < sizeof($list); $i++) {
			  if($list[$i]->getPmName() == $ccType){
			  	$this->internetkassa_PM = $list[$i]->getPmValue();
				$this->internetkassa_BRAND = $list[$i]->getPmBrand();
			  }
        }

		// set values
		// customer information
		$this->internetkassa_CN 			= $this->getCustomer()->getFirstname() . ' ' . $this->getCustomer()->getLastname();
		$this->internetkassa_EMAIL			= $this->getCustomer()->getEmail();
		//$this->internetkassa_owneraddress	=
		//$this->internetkassa_ownerZIP		=
		//$this->internetkassa_ownercty		=

		// order information
		$form->addField("amount", 'hidden', array('name' => 'amount', 'value' => round($this->getOrder()->getBaseGrandTotal(), 2)*100));
		$form->addField("orderID", 'hidden', array('name' => 'orderID', 'value' => $this->getOrder()->getRealOrderId()));

		$form->addField("PSPID", 'hidden', array('name' => 'PSPID', 'value' => $this->getInternetkassaPSPID()));

		$form->addField("Currency", 'hidden', array('name' => 'Currency', 'value' => $this->getInternetkassaCurrency()));

		$form->addField("Language", 'hidden', array('name' => 'Language', 'value' => $this->getInternetkassaLanguage()));

		$form->addField("PAGE_TITLE", 'hidden', array('name' => 'PAGE_TITLE', 'value' => $this->getInternetkassaTITLE()));
		$form->addField("BGCOLOR", 'hidden', array('name' => 'Language', 'value' => $this->getInternetkassaLanguage()));
		$form->addField("TXTCOLOR", 'hidden', array('name' => 'TXTCOLOR', 'value' => $this->getInternetkassaTXTCOLOR()));
		$form->addField("TBLBGCOLOR", 'hidden', array('name' => 'TBLBGCOLOR', 'value' => $this->getInternetkassaTBLBGCOLOR()));
		$form->addField("TBLTXTCOLOR", 'hidden', array('name' => 'TBLTXTCOLOR', 'value' => $this->getInternetkassaTBLTXTCOLOR()));
		$form->addField("BUTTONBGCOL", 'hidden', array('name' => 'BUTTONBGCOL', 'value' => $this->getInternetkassaBUTTONBGCOL()));
		$form->addField("BUTTONTXTCOLOR", 'hidden', array('name' => 'BUTTONTXTCOLOR', 'value' => $this->getInternetkassaBUTTONTXTCOLOR()));
		$form->addField("FONTTYPE", 'hidden', array('name' => 'FONTTYPE', 'value' => $this->getInternetkassaFONTTYPE()));
		$form->addField("LOGO", 'hidden', array('name' => 'LOGO', 'value' => $this->getInternetkassaLOGO()));
		$form->addField("TP", 'hidden', array('name' => 'TP', 'value' => $this->getInternetkassaTP()));

		$form->addField("accepturl", 'hidden', array('name' => 'accepturl', 'value' => $this->getInternetkassaAccepturl()));
		$form->addField("declineurl", 'hidden', array('name' => 'declineurl', 'value' => $this->getInternetkassaDeclineurl()));
		$form->addField("exceptionurl", 'hidden', array('name' => 'exceptionurl', 'value' => $this->getInternetkassaExceptionurl()));
		$form->addField("cancelurl", 'hidden', array('name' => 'cancelurl', 'value' => $this->getInternetkassaCancelurl()));
		$form->addField("homeurl", 'hidden', array('name' => 'homeurl', 'value' => $this->getInternetkassaHomeurl()));
		$form->addField("catalogurl", 'hidden', array('name' => 'catalogurl', 'value' => $this->getInternetkassaCatalogurl()));

		$form->addField("CN", 'hidden', array('name' => 'CN', 'value' => $this->getInternetkassaCN()));
		$form->addField("EMAIL", 'hidden', array('name' => 'EMAIL', 'value' => $this->getInternetkassaEMAIL()));
		$form->addField("PM", 'hidden', array('name' => 'PM', 'value' => $this->getInternetkassaPM()));
		$form->addField("BRAND", 'hidden', array('name' => 'BRAND', 'value' => $this->getInternetkassaBRAND()));

		$form->addField("Signature", 'hidden', array('name' => 'Signature', 'value' => $this->getInternetkassaSignature()));
		$form->addField("ownerZIP", 'hidden', array('name' => 'ownerZIP', 'value' => $this->getInternetkassaOwnerZIP()));
		$form->addField("owneraddress", 'hidden', array('name' => 'owneraddress', 'value' => $this->getInternetkassaOwneraddress()));
		$form->addField("ownercty", 'hidden', array('name' => 'ownercty', 'value' => $this->getInternetkassaOwnercty()));
		$form->addField("Alias", 'hidden', array('name' => 'Alias', 'value' => $this->getInternetkassaAlias()));
		$form->addField("AliasUsage", 'hidden', array('name' => 'AliasUsage', 'value' => $this->getInternetkassaAliasUsage()));
		$form->addField("AliasOperationCOM", 'hidden', array('name' => 'AliasOperationCOM', 'value' => $this->getInternetkassaAliasOperationCOM()));
		$form->addField("COMPLUS", 'hidden', array('name' => 'COMPLUS', 'value' => $this->getInternetkassaCOMPLUS()));
		$form->addField("PARAMPLUS", 'hidden', array('name' => 'PARAMPLUS', 'value' => $this->getInternetkassaPARAMPLUS()));
		$form->addField("PARAMVAR", 'hidden', array('name' => 'PARAMVAR', 'value' => $this->getInternetkassaPARAMVAR()));
		$form->addField("USERID", 'hidden', array('name' => 'USERID', 'value' => $this->getInternetkassaUSERID()));
		$form->addField("CreditCode", 'hidden', array('name' => 'CreditCode', 'value' => $this->getInternetkassaCreditCode()));

		$form->addField("SHASign", 'hidden', array('name' => 'SHASign', 'value' =>

			$this->signSHAOrder(
				$this->getOrder()->getRealOrderId(),
				round($this->getOrder()->getBaseGrandTotal(),2)*100,
				$this->getInternetkassaCurrency(),
				$this->getInternetkassaPSPID(),
				$this->getInternetkassaSHA1PASS()
			)
		));

		return $form;

	}

	/**
	 * Enter description here...
	 *
	 * @param string $orderID
	 * @param double $amount
	 * @param string $currency
	 * @param string $PSPID
	 * @param string $passSha
	 * @return sha1 signature for this parameters
	 */
	protected function signSHAOrder($orderID, $amount, $currency, $PSPID, $passSha){
		return sha1($orderID.$amount.$currency.$PSPID.$passSha);
	}

	 /**
     *  Return Order Place Redirect URL
     *
     *  @return	  string Order Redirect URL
     */
    public function getOrderPlaceRedirectUrl(){
    	return Mage::getUrl('internetkassa/result/redirect');
	}

	public function getCustomer()
    {
        if (empty($this->_customer)) {
            $this->_customer = Mage::getSingleton('customer/session')->getCustomer();
        }
        return $this->_customer;
    }

    public function getCheckout()
    {
        if (empty($this->_checkout)) {
            $this->_checkout = Mage::getSingleton('checkout/session');
        }
        return $this->_checkout;
    }

    public function getQuote()
    {
        if (empty($this->_quote)) {
            if (!$this->getCheckout()->getQuoteId()) {
                $this->getCheckout()->setQuoteId($this->getCheckout()->getInternetkassaQuoteId());
            }
            $this->_quote = $this->getCheckout()->getQuote();
        }
        return $this->_quote;
    }

    public function getOrder()
    {
        if (empty($this->_order)) {
            $order = Mage::getModel('sales/order');
            $order->loadByIncrementId($this->getCheckout()->getLastRealOrderId());
            $this->_order = $order;
        }
        return $this->_order;
    }


 /**
     * Checking response
     *
     * @param array $response
     * @return bool
     */
    public function checkResponse($response)
    {
        //TODO manage debugging
        if (isset(
        	$response['orderID'], $response['amount'],
            $response['STATUS'], $response['PAYID'],
            $response['PM'],$response['BRAND'])) {
            return true;
        }

        return false;
    }
}

