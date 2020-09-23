<?php

namespace App\Console\Commands;

use App\Menu;
use App\Items;
use App\Table;
use App\Branch;
use App\SubMenu;
use App\Restaurant;
use Illuminate\Console\Command;


class DataGenrator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        factory(Restaurant::class,10)->create()->each(function($u) {
            $branch = $u->branch()->saveMany(factory(Branch::class,2)->make());
            foreach($branch as $branchs){
                $table =  $branchs->table()->saveMany(factory(Table::class,5)->make());
                foreach($table as $tables){
                    $tables->resturent_id = $u->id;
                    $tables->save();
                }
                $menu =  $branchs->menu()->saveMany(factory(Menu::class,5)->make());
                foreach($menu as $menus){
                    $menus->items()->saveMany(factory(Items::class,10)->make());
                    $menus->branch_id = $branchs->id;
                    $menus->save();
                }
            }
        });
    }
}
