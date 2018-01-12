<?php

namespace DPRMC\IEXTrading;

use DPRMC\IEXTrading\Exceptions\InvalidStockChartOption;
use DPRMC\IEXTrading\Exceptions\UnknownSymbol;
use DPRMC\IEXTrading\Responses\StockChart;
use DPRMC\IEXTrading\Responses\StockQuote;
use DPRMC\IEXTrading\Responses\StockStats;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class IEXTrading {

    const URL = 'https://api.iextrading.com/1.0/';

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
                throw new InvalidStockChartOption( "You passed in [" . $option . "] as an option. Valid values are 5y, 2y, 1y, ytd, 6m, 3m, 1m, 1d, date, and dynamic." );

        endswitch;

        return new StockChart( $response, $option, $date );
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