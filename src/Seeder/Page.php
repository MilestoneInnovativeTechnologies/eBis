<?php

namespace Milestone\eBis\Seeder;

class Page extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = true;
  public static array $jsonIndices = [];

  public static array $fields = ['id', 'name', 'details', 'title', 'icon'];
  public static array $data = [
      [1, 'IndexPage', 'Index Page Details', 'Dashboard', 'mood']
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\Page::insert(self::getData());
  }
}
