<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;
 
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
 
    use AuthenticatesUsers;
 
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }
 
    public function login()
    {
 
     
        // $fontPath = str_replace('\\', '/', storage_path('fonts/Allura-Regular.ttf'));
 
        // $data = [
        //     'title' => 'Stylish Heading',
        //     'message' => 'Simple message paragraph.',
        //     'fontPath' => $fontPath
        // ];
   
        // $pdf = app('dompdf.wrapper');
        // $pdf->loadHTML(view('pdf.myview', $data)->render());
   
        // return $pdf->download('allura-font.pdf');
 
        return view('auth.login');
    }
 
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
 
        $email    = $request->email;
        $password = $request->password;
 
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();
 
        $activityLog = [
 
            'name'        => $email,
            'email'       => $email,
            'description' => 'has log in',
            'date_time'   => $todayDate,
        ];
        if (Auth::attempt(['email'=>$email,'password'=>$password,'status'=>'Active'])) {
            DB::table('activity_logs')->insert($activityLog);
             session()->flash('success', 'Login successful.');
            return redirect()->route('authenticate.loader');
        }elseif (Auth::attempt(['email'=>$email,'password'=>$password,'status'=> null])) {
            DB::table('activity_logs')->insert($activityLog);
                session()->flash('success', 'Login successful.');
            return redirect()->route('authenticate.loader');
        }
        else{
             session()->flash('error', 'Wrong username or password !...');
            return redirect('login');
        }
 
    }
 
    public function logout()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');
 
        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();
 
        $activityLog = [
 
            'name'        => $name,
            'email'       => $email,
            'description' => 'has logged out',
            'date_time'   => $todayDate,
        ];
        DB::table('activity_logs')->insert($activityLog);
        Auth::logout();
        // Toastr::success('Logout successfully :)','Success');
          session()->flash('success', 'Logout successfully ');
        return redirect('login');
    }
 
}
 
 