<?php

include_once dirname(__FILE__).'/ControlFraude.php';

class ControlFraude_Retail extends ControlFraude{

    protected function completeCFVertical(){
        $payDataOperacion = array();

        $payDataOperacion['CSSTCITY'] = $this->getCustomerField('city');
        $payDataOperacion['CSSTCOUNTRY'] = $this->getCustomerField('country');
        $payDataOperacion['CSSTEMAIL'] = $this->getCustomerField('email');

        $payDataOperacion['CSSTFIRSTNAME'] = $this->getCustomerField('firstname');
        $payDataOperacion['CSSTLASTNAME'] = $this->getCustomerField('lastname');

        $payDataOperacion['CSSTPHONENUMBER'] = $this->getField(phone::clean($this->getCustomerField('phone', false)));
        $payDataOperacion['CSSTPOSTALCODE'] = $this->getCustomerField('postcode');
        $payDataOperacion['CSSTSTATE'] = $this->_getStateCode($this->getCustomerField('state', false));
        $payDataOperacion['CSSTSTREET1'] = $this->getCustomerField('address');

        //$payDataOperacion['CSMDD12'] = Mage::getStoreConfig('payment/modulodepago2/cs_deadline');
        //$payDataOperacion['CSMDD13'] = $this->getField($this->order->getShippingDescription());
        //$payData ['CSMDD14'] = "";
        //$payData ['CSMDD15'] = "";
        //$payDataOperacion ['CSMDD16'] = $this->getField($this->order->getCuponCode());
        
        $payDataOperacion = array_merge($this->getMultipleProductsInfo(), $payDataOperacion);

        return $payDataOperacion;
    }

    protected function getCategoryArray($product_id){
        //return Mage::helper('modulodepago2/data')->getCategoryTodopago($product_id);
    }
    
    protected function getCustomerField($key, $clean = true) {
        $returnData = null;
        if (isset($this->customer['shipping' . $key])) {
            $returnData = $this->customer['shipping' . $key];
        } elseif (isset($this->customer['billing' . $key])) {
            $returnData = $this->customer['billing' . $key];
        }

        return $clean ? $this->getField($returnData) : $returnData;
    }
}
