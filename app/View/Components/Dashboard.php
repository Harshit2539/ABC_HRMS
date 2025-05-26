<?php
 
namespace App\View\Components;

use App\Models\HelpDeskRequest;
use App\Models\LeaveDetail;
use App\Models\TravelRecords;
use Illuminate\View\Component;
 
class Dashboard extends Component
{
    public $greeting;
    public $leaveCount;
    public $helpDeskCount;
    public $travelCount;

    public function __construct()
    {
        $hour = date('H');
        if ($hour >= 5 && $hour < 12) {
            $this->greeting = 'Good Morning';
        } elseif ($hour >= 12 && $hour < 17) {
            $this->greeting = 'Good Afternoon';
        } elseif ($hour >= 17 && $hour < 21) {
            $this->greeting = 'Good Evening';
        } else {
            $this->greeting = 'Good Night';
        }
        $this->leaveCount = LeaveDetail::count();
        $this->helpDeskCount = HelpDeskRequest::count();
        $this->travelCount = TravelRecords::count();


    }
 
    public function render()
    {
        return view('components.dashboard');
    }
}
 
 