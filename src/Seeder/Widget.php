<?php

namespace Milestone\eBis\Seeder;

class Widget extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = true;
  public static array $jsonIndices = [3,4];

  public static array $fields = ['id','name','type','attrs','groups'];
  public static array $data = [
      [1,'CashInHand', 1, ["bg" => "green", "icon" => "mdi-account-cash", "text" => "white", "title" => "Cash In Hand"], [1,2,4]],
      [2,'TotalReceivable', 1, ["bg" => "purple", "icon" => "mdi-cash-lock-open", "text" => "white", "title" => "Total Receivable"], [1,2,3,4]],
      [3,'TotalPayable', 1, ["bg" => "amber", "icon" => "mdi-cash-refund", "text" => "white", "title" => "Total Payable"], [1,2,3,4]],
      [4,'SalesToday', 1, ["bg" => "teal", "icon" => "mdi-cart-arrow-right", "text" => "white", "title" => "Sales Today"], [1,3]],
      [5,'PurchaseToSaleRatio', 23, ["width" => "95%", "colors" => ["lime", "green"], "height" => 256, "legend" => false, "heading" => "Purchase/Sale"], [1,3]],
      [6,'14DaysSale', 8, ["color" => "green", "height" => 256, "legend" => false, "heading" => "Last 14 Day Sales", "yFormat" => "parseInt(value/1000) + ' k'"], [1,3]],
      [7,'14DaysPurchase', 8, ["color" => "lime", "height" => 256, "legend" => false, "heading" => "Last 14 Day Purchases", "yFormat" => "parseInt(value/1000) + ' k'"], [1,3]],
      [8,'PayableReceivablePie', 12, ["colors" => ["amber", "purple"], "height" => 256, "legend" => false, "heading" => "Payable/Receivable"], [1,2,4]],
      [9,'Top10Receivables', 9, ["color" => "purple", "height" => 256, "legend" => false, "heading" => "Top 10 Receivables", "xFormat" => "value.substr(0,10) + '...'"], [1,2,4]],
      [10,'Top10Payable', 9, ["color" => "amber", "height" => 256, "legend" => false, "heading" => "Top 10 Payable", "xFormat" => "value.substr(0,10) + '...'"], [1,2,4]],
      [11,'AgedReceivables', 10, ["color" => "purple", "height" => 180, "legend" => false, "heading" => "Aged Receivables", "xFormat" => "parseInt(value/1000000) + ' m'"], [1,2,4]],
      [12,'AgedPayable', 10, ["color" => "amber", "height" => 180, "legend" => false, "heading" => "Aged Payable", "xFormat" => "parseInt(value/1000000) + ' m'"], [1,2,4]]
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\Widget::insert(self::getData());
  }
}
