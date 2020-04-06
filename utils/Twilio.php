<?php

namespace Utils;

class Twilio {

    private $sid = "ACb3c9cf6605d113c444c0d74d1766c13a"; // Your Account SID from www.twilio.com/console
    private $token = "877a7436df10ea94e6ea1d965ae7e310"; // Your Auth Token from www.twilio.com/console

    private $client;

    public function __construct() {
        $this->client = new \Twilio\Rest\Client($this->sid, $this->token);
    }

    public function sendSMS($from, $body, $to) {
        $message = $this->client->messages->create(
            $to, // Text this number
            array(
                'from' => $from, // From a valid Twilio number
                'body' => $body
            )
        );
        return $message->sid;
    }

}














