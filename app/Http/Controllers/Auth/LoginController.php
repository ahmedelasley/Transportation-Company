<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    
    protected function credentials(Request $request)
    {
        return ['email' => $request->email, 'password' => $request->password];
    }
    
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
     

        if (Auth::attempt($this->credentials($request) )) {

            // Insert Code in Database
            $user = User::where('email', $request->email )->first();

            // $user->generateCode();

            // Send Code to Mail
            // $user->notify(new TwoFactorCode());

            // Send Code to Mobile
            // $basic  = new Basic("72f0b29d", "3kzLuMvYefPulzts");
            // $client = new Client($basic);

            // $response = $client->sms()->send(
            //     new SMS($user->phone, "BRAND_NAME", 'A text message sent using the Nexmo SMS API'.$user->code)
            // );



            
            
            // $message = $response->current();
            
            // if ($message->getStatus() == 0) {
            //     echo "The message was sent successfully\n";
            // } else {
            //     echo "The message failed with status: " . $message->getStatus() . "\n";
            // }





            // $message = 'كود التحقق الخاص بك هو '. $user->code;
            // $account_sid = getenv('TWILIO_SID');
            // $auth_token = getenv('TWILIO_TOKEN');
            // $twilio_number = getenv('TWILIO_FROM');
            // $recipient = $user->phone;
            
            // $client = new Client($account_sid, $auth_token);
            // $client->account->messages->create($recipient, [
            //     'from' => $twilio_number,
            //     'body' => $message,
            // ]);


            // $receiverNumber = $user->phone;
            // $message = 'كود التحقق الخاص بك هو '. $user->code;
      
            // try {
      
            //     $account_sid = getenv("TWILIO_SID");
            //     $auth_token = getenv("TWILIO_TOKEN");
            //     $twilio_number = getenv("TWILIO_FROM");
      
            //     $client = new Client($account_sid, $auth_token);
            //     $client->account->messages->create($receiverNumber, [
            //         'from' => $twilio_number, 
            //         'body' => $message]);
      
            //     dd('SMS Sent Successfully.');
      
            // } catch (Exception $e) {
            //     dd("Error: ". $e->getMessage());
            // }

            return redirect($this->redirectTo);
        }
    
        return redirect("login")->withSuccess('عفوا! لقد قمت بإدخال بيانات اعتماد غير صالحة');
        // ->with('success','Product updated successfully');

        
    }






        /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
