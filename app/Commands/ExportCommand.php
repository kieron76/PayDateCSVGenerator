<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\CSVRecord;
use App\CSVExporter;
use App\PayDate;

class ExportCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'export {date?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Write a csv of months, base pay dates and bonus pay dates';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $csvExporter = new CSVExporter;
        $headerRecord = new CSVRecord;

	if (!empty($this->argument('date')))
            $dates = new PayDate(new \DateTime($this->argument('date')));
        else
            $dates = new PayDate;

        $this->info('Writing CSV File');

        $headerRecord->addField('MonthName', 'MonthName')
            ->addField('BasePayDate', 'BasePayDate')
            ->addField('BonusPayDate', 'BonusPayDate');

        $csvExporter->addRecord($headerRecord);

        for ($month = 0; $month<11; $month++) {

            $record = new CSVRecord;
            $record->addField('MonthName', $dates->getMonthName($month))
               ->addField('BasePayDate', $dates->getBasePayDate($month)->format('d-m-y'))
               ->addField('BonusPayDate', $dates->getBonusPayDate($month)->format('d-m-y'));

            $csvExporter->addRecord($record);
        }

        $csvExporter->export();
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
