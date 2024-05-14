<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ginota_api {

    private $key = 'qKNwmU66SLt61BvaxJFDMvF%2Bf0JZxwCiwa%2BzN5ZF4Js%3D';
    private $secret = 'Y2O!@FWoU%23';
    private $addr = 'DISHUBSLAWI';
    private $baseurl = 'https://www.ginota.com';

    public function send($telp, $sms) {

        @file($authurl = $this->baseurl . '/gemp/sms/json?apiKey=' . $this->key . '&apiSecret=' . $this->secret . '&srcAddr=' . $this->addr . '&dstAddr='.$telp.'&content='.$sms.'');
		//echo $authurl;
	}

}

?>