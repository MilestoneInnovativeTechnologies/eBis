<?php

namespace Milestone\eBis\Seeder;

class Layout extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = true;
  public static array $jsonIndices = [2];

  public static array $fields = ['id', 'name', 'sections'];
  public static array $data = [
      [1, 'IndexPageLayout', [1, 2, 3, 4]]
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\Layout::insert(self::getData());
  }
}
