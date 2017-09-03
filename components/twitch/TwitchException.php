<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\twitch;

/**
 * TwitchException for TwitchTV API SDK for PHP
 *
 * PHP SDK for interacting with the TwitchTV API

 *
 * @author Nikadimas
 */
class TwitchException extends \Exception {

    /** @var TwitchException */
    protected $previous;

    public function __construct($message = null, $code = 0, TwitchException $previous = null) {
        $this->code = $code;
        if ($message !== null) {
            $this->message = $message;
        }
        $this->previous = $previous;
        parent::__construct($this->message, $this->code, $this->previous);
    }

    /**
     * Formatted string for display
     * @return  string
     */
    public function __toString() {
        return __CLASS__ . ': [' . $this->code . ']: ' . $this->message;
    }

}
