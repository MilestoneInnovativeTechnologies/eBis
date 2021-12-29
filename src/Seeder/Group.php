<?php

namespace Milestone\eBis\Seeder;

class Group extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = true;
  public static array $jsonIndices = [];

  public static array $fields = ['id','code','name'];
  public static array $data = [
    [1,'ADM','Administrators'],
    [2,'ACC','Accountant'],
    [3,'SLS','Sales Executive'],
    [4,'FM','Finance Manager'],
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\Group::insert(self::getData());
  }
}
