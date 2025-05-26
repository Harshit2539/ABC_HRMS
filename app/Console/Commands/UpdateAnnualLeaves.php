<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\EmployeeAnnualLeave;
use App\Models\EmployeeLeaveLogs;
use App\Models\AnnualLeave;
 
 
 
 
 
class UpdateAnnualLeaves extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:annualLeaves';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Employee Annual leaves on year end ';
 
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
     * @return int
     */
    public function handle()
    {
        // php artisan update:annualLeaves
 
        $annual_year = Carbon::now()->year;
        $total_leaves = AnnualLeave::where('year', $annual_year)->first();
        Log::alert('cron working');
        $employee_annual_leave =  EmployeeAnnualLeave::all();
 
        foreach($employee_annual_leave as $record){
            EmployeeLeaveLogs::create($record->toArray());
        }
 
        foreach($employee_annual_leave as $record){
            $record->loss_of_pay = 0;
            $record->comp_off =0;
            $record->annual_leave = 0;
            $record->work_from_home = 0;
            $record->sick_leave = 0 ;
           
            $record->total_sick_leave += $total_leaves->sick_leave;
            $record->total_annual_leave += $total_leaves->annual_leave;
            $record->total_wfh += $total_leaves->work_from_home;
 
            $record->year += 1;
            $record->save();
        }
 
    }
 
}
 
 
 