<?php

namespace Drupal\stock_formula\Http;

use GuzzleHttp\Exception\RequestException;

/**
 * Http client for Stock Formula.
 */
class StockFormulaHttp {

  public function httpRequestPrice($symbol) {

    $client = \Drupal::httpClient();

    $siteUrl = 'https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=' . $symbol . '&apikey=A2CBMPCI5CHL1M5O&outputsize=full';

    //$siteUrl = 'https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=L.TO&apikey=A2CBMPCI5CHL1M5O&outputsize=full';

    try {

      $today = time();

      $startdate = date('Y-m-d', strtotime("-5 days", $today));

      $request = $client->get($siteUrl);

      $response = json_decode($request->getBody(), true);

      $close = $response['Time Series (Daily)'][$startdate]['4. close'];

      //Uncomment this to see the full response
      return('<pre>' . print_r($response, 1) . '</pre>');

      //return($symbol . ' date: ' . $startdate . ' close: ' . $close);

    } catch (RequestException $e) {

      return($this->t('Error'));

    }
  }
}
