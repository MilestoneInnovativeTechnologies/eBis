<?php

namespace Milestone\eBis\Seeder;

class Section extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = true;
  public static array $jsonIndices = [3];

  public static array $fields = ['id', 'name', 'title', 'widgets'];
  public static array $data = [
      [1, 'MainMetrics', NULL, ["1" => 3, "2" => 3, "3" => 3, "4" => 3]],
      [2, 'PurchaseSale', NULL, ["5" => 2, "6" => 5, "7" => 5]],
      [3, 'PayReceive', NULL, ["8" => 2, "9" => 5, "10" => 5]],
      [4, 'AgedPayReceive', NULL, ["11" => 6, "12" => 6]]
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\Section::insert(self::getData());
  }
}
