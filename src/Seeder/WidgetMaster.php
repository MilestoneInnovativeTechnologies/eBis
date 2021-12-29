<?php

namespace Milestone\eBis\Seeder;

class WidgetMaster extends Seeder
{
  use SeederTrait;

  public static bool $timestamps = true;
  public static array $jsonIndices = [2];

  public static array $fields = ['component','name','attrs'];
  public static array $data = [
    ['DigitMetric','DigitMetric',['bg' => 'blue', 'value' => '', 'text' => 'white', 'title' => 'Title', 'icon' => 'award']],
    ['Progress','Progress',['color' => 'primary', 'value' => '', 'size' => 'xl', 'title' => 'Title']],
    ['DetailMetric','DetailMetric',['color' => 'indigo', 'shadow' => false, 'square' => true, 'text' => 'white', 'value' => '', 'progress' => '50', 'title' => ' ', 'detail' => ' ', 'icon' => 'mood', 'uppercase' => true]],
    ['CircularProgress','CircularProgress',['value' => 100,'color' => 'primary', 'track' => 'grey-3', 'show' => true, 'title' => 'Title']],
    ['SimpleMetric','SimpleMetric',['shadow' => true, 'value' => '', 'icon' => '', 'title' => 'Title']],
    ['SummaryBlock','SummaryBlock',['value' => '', 'title' => 'Title']],
    ['SimpleLineChart','SimpleLineChart',null],
    ['SimpleAreaChart','SimpleAreaChart',null],
    ['SimpleBarChart','SimpleBarChart',null],
    ['SimpleHorizontalBarChart','SimpleHorizontalBarChart',null],
    ['SimplePieChart','SimplePieChart',["mode" => "dataset"]],
    ['SimpleDoughnutChart','SimpleDoughnutChart',["mode" => "dataset"]],
    ['LineChart','LineChart',["mode" => "index"]],
    ['AreaChart','AreaChart',["mode" => "index"]],
    ['StackedAreaChart','StackedAreaChart',["mode" => "index"]],
    ['BarChart','BarChart',null],
    ['StackedBarChart','StackedBarChart',["mode" => "index"]],
    ['HorizontalBarChart','HorizontalBarChart',null],
    ['StackedHorizontalBarChart','StackedHorizontalBarChart',["mode" => "index"]],
    ['PieChart','PieChart',["mode" => "dataset"]],
    ['DoughnutChart','DoughnutChart',["mode" => "dataset"]],
    ['RadarChart','RadarChart',null],
    ['PolarAreaChart','PolarAreaChart',null],
  ];


  /**
   * Run the database seeders.
   *
   * @return void
   */
  public function run()
  {
      \Milestone\eBis\Model\WidgetMaster::insert(self::getData());
  }
}
