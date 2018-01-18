<?php

namespace DPRMC\IEXTrading\Responses;

use Carbon\Carbon;

class StockFinancialReport {


    public $reportDate;
    public $grossProfit;
    public $costOfRevenue;
    public $operatingRevenue;
    public $totalRevenue;
    public $operatingIncome;
    public $netIncome;
    public $researchAndDevelopment;
    public $operatingExpense;
    public $currentAssets;
    public $totalAssets;
    public $totalLiabilities;
    public $currentCash;
    public $currentDebt;
    public $totalCash;
    public $totalDebt;
    public $shareholderEquity;
    public $cashChange;
    public $cashFlow;
    public $operatingGainsLosses;
    public $carbonReportDate;


    public function __construct( $data ) {
        $this->reportDate             = $data[ 'reportDate' ];
        $this->grossProfit            = $data[ 'grossProfit' ];
        $this->costOfRevenue          = $data[ 'costOfRevenue' ];
        $this->operatingRevenue       = $data[ 'operatingRevenue' ];
        $this->totalRevenue           = $data[ 'totalRevenue' ];
        $this->operatingIncome        = $data[ 'operatingIncome' ];
        $this->netIncome              = $data[ 'netIncome' ];
        $this->researchAndDevelopment = $data[ 'researchAndDevelopment' ];
        $this->operatingExpense       = $data[ 'operatingExpense' ];
        $this->currentAssets          = $data[ 'currentAssets' ];
        $this->totalAssets            = $data[ 'totalAssets' ];
        $this->totalLiabilities       = $data[ 'totalLiabilities' ];
        $this->currentCash            = $data[ 'currentCash' ];
        $this->currentDebt            = $data[ 'currentDebt' ];
        $this->totalCash              = $data[ 'totalCash' ];
        $this->totalDebt              = $data[ 'totalDebt' ];
        $this->shareholderEquity      = $data[ 'shareholderEquity' ];
        $this->cashChange             = $data[ 'cashChange' ];
        $this->cashFlow               = $data[ 'cashFlow' ];
        $this->operatingGainsLosses   = $data[ 'operatingGainsLosses' ];

        $this->carbonReportDate = Carbon::createFromFormat( 'Y-m-d', $this->reportDate, 'EST' )->setTime( 0, 0, 0 );
    }

}