<?php

namespace Milestone\eBis\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            WidgetMaster::class,
            Group::class,
            Widget::class,
            Section::class,
            Layout::class,
            Page::class,
            GroupPageLayout::class
        ]);
    }
}
