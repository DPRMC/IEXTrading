<?php

use DPRMC\IEXTrading\IEXTrading;
use PHPUnit\Framework\TestCase;

class IEXTradingTest extends TestCase {

    public function testStockStatsWithInvalidTicker() {
        $this->expectException( \DPRMC\IEXTrading\Exceptions\UnknownSymbol::class );
        IEXTrading::stockStats( 'thisisafaketicker' );
    }

    public function testStockStats() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockStats $stockStats
         */
        $stockStats = IEXTrading::stockStats( 'aapl' );
        $this->assertEquals( 'Apple Inc.', $stockStats->companyName );
    }

    public function testStockQuote() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockQuote $stockQuote
         */
        $stockQuote = IEXTrading::stockQuote( 'aapl' );
        $this->assertEquals( 'Apple Inc.', $stockQuote->companyName );
    }


    /**
     * @throws \DPRMC\IEXTrading\Exceptions\InvalidStockChartOption
     * @throws \Exception
     * @group chart
     */
    public function testStockChartDynamic() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_DYNAMIC );
        $this->assertInstanceOf( \DPRMC\IEXTrading\Responses\StockChart::class, $stockChart );
    }

    public function testStockChartDate() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_DATE, '20180103' );
        $this->assertInstanceOf( \DPRMC\IEXTrading\Responses\StockChart::class, $stockChart );
    }

    public function testStockChartOneMonth() {
        /**
         * @var \DPRMC\IEXTrading\Responses\StockChart $stockChart
         */
        $stockChart = IEXTrading::stockChart( 'aapl', \DPRMC\IEXTrading\Responses\StockChart::OPTION_1M );
        $this->assertInstanceOf( \DPRMC\IEXTrading\Responses\StockChart::class, $stockChart );
    }

    public function testStockChartWithInvalidOptionShouldThrowException() {
        $this->expectException( Exception::class );
        IEXTrading::stockChart( 'aapl', 'notValidOption' );
    }



}