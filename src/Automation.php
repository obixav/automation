<?php

namespace Obiako\Automation;

//use Redis;

class Automation extends \Redis
{
    public $config=[];
    public function __construct($host, $port = 6379, $timeout = 0.0, $reserved = null, $retry_interval = 0, $read_timeout = 0.0,$store_calling_class=false)
    {
        if($store_calling_class==true){
            $this->setOpt(\Redis::OPT_PREFIX, 'calling_class:'.$this->get_calling_class());
        }


       $this->connect($host, $port , $timeout, $reserved , $retry_interval, $read_timeout);
    }
    public function get_calling_class() {

    //get the trace
    $trace = debug_backtrace();

    // Get the class that is asking for who awoke it
    $class = $trace[1]['class'];

    // +1 to i cos we have to account for calling this function
    for ( $i=1; $i<count( $trace ); $i++ ) {
        if ( isset( $trace[$i] ) ) // is it set?
             if ( $class != $trace[$i]['class'] ) // is it a different class
                 return $trace[$i]['class'];
    }
}
}