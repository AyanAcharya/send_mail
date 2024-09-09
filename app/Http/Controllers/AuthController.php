<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','logout',' data_table','send_mail','store_data','modal_data']]);
        
    } 
   
// =============================================================================================-
  
// =============================================================================================-
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL(),
            'user' => auth()->user()
        ]);
    }

// =============================================================================================-
    public function logout()
    {
        try{
            auth()->logout();
            return response()->json(['success'=>true,'message' => 'User successfully logged out']);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
            
        }
    }

    // =============================================================================================-
    public function store_data(Request $request)
    {
        try {
           
            $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'company' => 'required|string',
            'event' => 'required|string',
            'attendees' => 'required|in:<400,400-1000,1k-5k,5k-25k,25k-50k,50k-100k,>100k',
            'features' => 'required|string',
            'field' => 'string',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $field2Value = $request->input('field');

        if (empty($field2Value)) {
            $field2Value = "no-data";
        }

        DB::table('data')->insert([
            'Name' => $request->input('name'),
            'Email' => $request->input('email'),
            'Company_name' => $request->input('company'),
            'Event_name' => $request->input('event'),
            'Expected_attendees' => intval($request->input('attendees')),
            'Features' => $request->input('features'),
            'About' => $field2Value,
        ]);

        return response()->json(['success' => true]);
    } catch (Exception $e) {
        return response()->json(['success' => false]);
    }
}
// =============================================================================================-
public function data_table()
{

    if (auth()->check()) {

        $showdata = DB::table('data')->get();

        return response()->json(['success' => true, 'msg' => 'Data fetched successfully', 'result' => $showdata]);
    } else {
        return response()->json(['success' => false, 'message' => 'User not authenticated']);
    }
}
// =============================================================================================-
public function modal_data(Request $request)
{
try {
       
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'User is not authenticated.']);
    }

   
    $validator = Validator::make($request->all(), [
        'id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => 'Validation error.', 'errors' => $validator->errors()]);
    }
    $id = $request->input('id'); 

        $showdata = DB::table('data')
        ->where('id',$id)->get();

        return response()->json(['success' => true, 'message' => 'Data fetched successfully', 'result' => $showdata]);
    } catch(\Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()]);
    }
}
// =============================================================================================-
public function send_mail(Request $request)
{
   
    if (auth()->check()) {
       
        $email = $request->input('email');
        $message = $request->input('message');
        $uid = $request->input('id');

        
        require base_path('vendor/autoload.php');
        $mail = new PHPMailer();

        try {
        
            $mail->isSMTP();
            $mail->Host       = 'mail.smtp2go.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'udayan@teks.co.in';
            $mail->Password   = 'oZwKbFBM9yV9mQBj'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 2525;

          
            $mail->setFrom('ayan@teks.co.in', 'Mailer');
            $mail->addAddress($email);

            
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          
            $mail->send();

            
            DB::table('data')
                ->where('id', $uid)
                ->update(['reply' => 1]);

            return response()->json(['success' => true, 'message' => 'Mail sent successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'User not authenticated']);
    }
}
















}