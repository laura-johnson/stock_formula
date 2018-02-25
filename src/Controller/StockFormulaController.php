<?php

namespace Drupal\stock_formula\Controller;

use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\stock_formula\Http\StockFormulaHttp;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatterInterface;


/**
 * {@inheritdoc}
 */

class StockFormulaController extends ControllerBase {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs a \Drupal\aggregator\Controller\AggregatorController object.
   *
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The date formatter service.
   */
  public function __construct(DateFormatterInterface $date_formatter) {
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('date.formatter')
    );
  }

  public function performRequest() {

    $http = new StockFormulaHttp();

    $symbolArray = ['L.TO', 'MTN'];

    $return = [];

    foreach ($symbolArray as $symbol) {
       $return[] = $http->httpRequestPrice($symbol);
    }


      return array(
        '#type' => 'markup',
        '#markup' => print_r($return, 1)
      );
    }

}
