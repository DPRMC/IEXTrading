<?php

namespace DPRMC\IEXTrading\Responses;

class StockNewsItem {

    public $datetime;
    public $headline;
    public $source;
    public $url;
    public $summary;
    public $related;


    public function __construct( $a ) {
        $this->datetime = $a[ 'datetime' ];
        $this->headline = $a[ 'headline' ];
        $this->source   = $a[ 'source' ];
        $this->url      = $a[ 'url' ];
        $this->summary  = $a[ 'summary' ];
        $this->related  = $a[ 'related' ];

    }

}