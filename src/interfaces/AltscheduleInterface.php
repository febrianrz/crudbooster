<?php
namespace crocodicstudio\crudbooster\interfaces;

use Illuminate\Console\Scheduling\Schedule;

interface AltscheduleInterface {
    
    public function run(Schedule $schedule);

}