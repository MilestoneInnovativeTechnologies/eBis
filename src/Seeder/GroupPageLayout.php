<?php

namespace Milestone\eBis\Seeder;

class GroupPageLayout extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = false;
  public static array $jsonIndices = [];

  public static array $fields = ['group', 'page', 'layout'];
  public static array $data = [
      [1, 1, 1]
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\GroupPageLayout::insert(self::getData());
  }
}
