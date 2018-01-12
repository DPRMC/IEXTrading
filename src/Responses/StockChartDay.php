<?php

namespace DPRMC\IEXTrading\Responses;

class StockChartDay extends StockChartData {

    public $date;
    public $open;
    public $close;
    public $unadjustedVolume;
    public $change;
    public $changePercent;
    public $vwap;

    public $high;
    public $low;
    public $volume;
    public $label;
    public $changeOverTime;


    public function __construct( array $dataPoint ) {
        parent::__construct( $dataPoint );
        $this->date             = $dataPoint[ 'date' ];
        $this->open             = $dataPoint[ 'open' ];
        $this->close            = $dataPoint[ 'close' ];
        $this->unadjustedVolume = $dataPoint[ 'unadjustedVolume' ];
        $this->change           = $dataPoint[ 'change' ];
        $this->changePercent    = $dataPoint[ 'changePercent' ];
        $this->vwap             = $dataPoint[ 'vwap' ];
        $this->high             = $dataPoint[ 'high' ];
        $this->low              = $dataPoint[ 'low' ];
        $this->volume           = $dataPoint[ 'volume' ];
        $this->label            = $dataPoint[ 'label' ];
        $this->changeOverTime   = $dataPoint[ 'changeOverTime' ];
    }
}