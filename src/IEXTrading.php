<?php

namespace DPRMC\IEXTrading;

use DPRMC\IEXTrading\Exceptions\InvalidStockChartOption;
use DPRMC\IEXTrading\Exceptions\ItemCountPassedToStockNewsOutOfRange;
use DPRMC\IEXTrading\Exceptions\UnknownSymbol;
use DPRMC\IEXTrading\Responses\StockChart;
use DPRMC\IEXTrading\Responses\StockCompany;
use DPRMC\IEXTrading\Responses\StockFinancials;
use DPRMC\IEXTrading\Responses\StockLogo;
use DPRMC\IEXTrading\Responses\StockNews;
use DPRMC\IEXTrading\Responses\StockPeers;
use DPRMC\IEXTrading\Responses\StockPrice;
use DPRMC\IEXTrading\Responses\StockQuote;
use DPRMC\IEXTrading\Responses\StockRelevant;
use DPRMC\IEXTrading\Responses\StockStats;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class IEXTrading {

    const URL = 'https://api.iextrading.com/1.0/';

    /**
     * @param string $ticker Use market to get market-wide news
     * @param null   $items  How many news items do you want? Number between 1 and 50. Default is 10
     *
     * @return \DPRMC\IEXTrading\Responses\StockNews
     * @throws \DPRMC\IEXTrading\Exceptions\ItemCountPassedToStockNewsOutOfRange
     * @throws \DPRMC\IEXTrading\Exceptions\UnknownSymbol
     * @throws \Exception
     */
    public static function stockNews( $ticker = 'market', $items = null ) {
        if ( isset( $items ) && ( $items < 1 || $items > 50 ) ):
            throw new ItemCountPassedToStockNewsOutOfRange( "If you pass in a date it needs to be a number between 1 and 50. You passed in " . $items );
        endif;

        if ( isset( $items ) ):
            $uri = 'stock/' . $ticker . '/news/last/' . $items;
        else:
            $uri = 'stock/' . $ticker . '/news';
        endif;
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockNews( $response );
    }

    /**
     * @param $ticker
     *
     * @return \DPRMC\IEXTrading\Responses\StockStats
     * @throws \DPRMC\IEXTrading\Exceptions\UnknownSymbol
     * @throws \Exception
     */
    public static function stockStats( $ticker ) {
        $uri      = 'stock/' . $ticker . '/stats';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockStats( $response );
    }

    /**
     * @param $ticker
     *
     * @return \DPRMC\IEXTrading\Responses\StockQuote
     * @throws \DPRMC\IEXTrading\Exceptions\UnknownSymbol
     * @throws \Exception
     */
    public static function stockQuote( $ticker ) {
        $uri      = 'stock/' . $ticker . '/quote';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockQuote( $response );
    }

    public static function stockCompany( $ticker ) {
        $uri      = 'stock/' . $ticker . '/company';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockCompany( $response );
    }

    public static function stockPeers( $ticker ) {
        $uri      = 'stock/' . $ticker . '/peers';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockPeers( $response );
    }

    public static function stockRelevant( $ticker ) {
        $uri      = 'stock/' . $ticker . '/relevant';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockRelevant( $response );
    }



    /**
     * @param      string $ticker A valid stock ticker Ex: AAPL for Apple
     * @param      string $option Valid values: 5y, 2y, 1y, ytd, 6m, 3m, 1m, 1d, date, and dynamic
     * @param null string $date Only used with the 'date' $option passed in. Expected format: yyyymmdd
     *
     * @return StockChart
     * @throws \DPRMC\IEXTrading\Exceptions\InvalidStockChartOption
     * @throws \Exception
     */
    public static function stockChart( $ticker, $option, $date = null ) {
        $uri = 'stock/' . $ticker . '/chart/' . $option;

        switch ( $option ):
            case '5y':
            case '2y':
            case '1y':
            case 'ytd':
            case '6m':
            case '3m':
            case '1m':
            case '1d':
            case 'dynamic':
                $response = IEXTrading::makeRequest( 'GET', $uri );
                break;
            case 'date':
                $uri      .= '/' . $date;
                $response = IEXTrading::makeRequest( 'GET', $uri );
                break;
            default:
                throw new InvalidStockChartOption( "When calling stockChart() you passed in [" . $option . "] as an option. Valid values are 5y, 2y, 1y, ytd, 6m, 3m, 1m, 1d, date, and dynamic." );

        endswitch;

        return new StockChart( $response, $option, $date );
    }

    public static function stockFinancials( $ticker ) {
        $uri      = 'stock/' . $ticker . '/financials';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockFinancials( $response );
    }

    public static function stockLogo( $ticker ) {
        $uri      = 'stock/' . $ticker . '/logo';
        $response = IEXTrading::makeRequest( 'GET', $uri );

        return new StockLogo( $response );
    }

    public static function stockPrice( $ticker ) {
        $uri        = 'stock/' . $ticker . '/price';
        $response   = IEXTrading::makeRequest( 'GET', $uri );
        $jsonString = (string)$response->getBody();
        $price      = \GuzzleHttp\json_decode( $jsonString, true );

        return (float)$price;
    }


    /**
     * Set up and return a GuzzleHttp Client with some default settings.
     * @return \GuzzleHttp\Client
     */
    protected static function getClient() {
        return new Client( [
                               'verify'   => false,
                               'base_uri' => IEXTrading::URL,
                           ] );
    }

    /**
     * Makes the request and handles any exceptions that the IEXTrading.com system might return.
     *
     * @param $method
     * @param $uri
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \DPRMC\IEXTrading\Exceptions\UnknownSymbol
     * @throws \Exception
     */
    protected static function makeRequest( $method, $uri ) {
        $client = IEXTrading::getClient();
        try {
            return $client->request( $method, $uri );
        } catch ( ClientException $clientException ) {
            if ( 'Unknown symbol' == $clientException->getResponse()->getBody() ):
                throw new UnknownSymbol( "IEXTrading.com replied with: " . $clientException->getResponse()->getBody() );
            endif;
            throw $clientException;
        } catch ( \Exception $exception ) {
            throw $exception;
        }
    }

}