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


    public function __construct( array $dataPoint ) {
        parent::__construct( $dataPoint );
        $this->date             = $dataPoint[ 'date' ];
        $this->open             = $dataPoint[ 'open' ];
        $this->close            = $dataPoint[ 'close' ];
        $this->unadjustedVolume = $dataPoint[ 'unadjustedVolume' ];
        $this->change           = $dataPoint[ 'change' ];
        $this->changePercent    = $dataPoint[ 'changePercent' ];
        $this->vwap             = $dataPoint[ 'vwap' ];
    }


}