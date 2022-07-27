<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Claim;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\claimsController;
use Hash;
use Mail;
//use Illuminate\Support\Facades\Mail;
use Session;
use App\Models\City;

class AuthController extends Controller
{
    public function login (){
    	return view ("auth.login");
    }
    public function registration() {
    	return view ("auth.registration");
    }
    public function registerUser(Request $request){

    	$request->validate([
    		'name'=>'required',
    		'email'=>'required|email|unique:users',
    		'password'=>'required|min:5|max:16',
            'last_name'=>'required',
            'full_ssn'=>'required',
            'dob'=>'required',
            'address'=>'required',
            'state'=>'required',
            'city'=>'required',
            'zipcode'=>'required',
            'marital_status'=>'required',
            'gender'=>'required',
            'date_of_withdrawal'=>'required',
            'docs'=>'required'
    	]);

        $path = 'user/images';
        $fontpath = public_path('fonts/oliciy.ttf');
        $char = strtoupper($request->name[0]);
        $newAvatarname = rand(12,34355).time().'_avatar.png';
        $dest = $path.$newAvatarname;

        $createAvatar = makeAvatar($fontpath, $dest, $char);
        $avatar = $createAvatar == true ? $newAvatarname : '';

    	$user = new user();
    	$user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->full_ssn = $request->full_ssn;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->marital_status = $request->marital_status;
        $user->gender = $request->gender;
        $user->date_of_withdrawal = $request->date_of_withdrawal;
        $user->docs = $request->docs;
    	$user->email = $request->email;
        $user->avatar = $avatar;
        $user->user_balance = '0';
    	$user->password = Hash::make($request->password); 
    	$res = $user->save();
    	if ($res) {
            $headers = "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Entity-Ref-ID: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
            // More headers
            $sender_email = "nouman@napollo.net";
            $headers .= 'From:<'.$sender_email.'>' . "\r\n";
            //send email
            if(@mail($user->email,'Intrustpit Account','Your have successfully registered with Intrustpit. Your profile is under review and we will get back in 24/48hours.',$headers)){
                echo "Successfully Send";
            }else{
                echo "Sending Failed";
            }           
    		return back()->with('success', 'User Successfully Registered');              
    	}else {
    		return back()->with('fail', 'Something went wrong!');
    	}      
    }   
    public function loginUser(Request $request){
    	$request->validate([
    		'email'=>'required|email',
    		'password'=>'required|min:5|max:16'
    	]);
    	$user = User::where('email', '=', $request->email)->first();
    	if ($user) {
    	    if(Hash::check($request->password,$user->password)){
    	    	$request->Session()->put('loginId', $user->id);
    	    	return redirect('dashboard');
    	    }else {
    	    	return back()->with('fail', 'Wrong password, forget your password?');
    	    }
    	}else {
    		return back()->with('fail', 'Seems like you are not registered.');
    	}    	
    }
    public function dashboard(Request $request){
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%.")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {


            $role = User::where('id', '=', Session::get('loginId'))->value('role');
            //dd($role);

            if ($role == 'Admin'){
             $claims = Claim::orderBy('id', 'desc')->paginate(15);
             $all_users = User::all();
            $total_users = DB::table('users')->count('id');
            $user_balance = DB::table('users')->sum('user_balance');
            $sum_processed = DB::table('claims')->where('claim_status', 'processed')->count('id');
            $sum_pending = DB::table('claims')->where('claim_status', 'pending')->count('id');
            $sum_approved = DB::table('claims')->where('claim_status', 'approved')->count('id');
            $sum_refused = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'refused')->count('id');
            $sum_processed_amount = DB::table('claims')->where('claim_status', 'processed')->sum('claim_amount');
            $sum_approved_amount = DB::table('claims')->where('claim_status', 'approved')->sum('claim_amount');
            $sum_refused_amount = DB::table('claims')->where('claim_status', 'refused')->sum('claim_amount');
            $sum_pending_amount = DB::table('claims')->where('claim_status', 'pending')->sum('claim_amount');
            $sum_claims = DB::table('claims')->count('id');
            $sum_claims_amount = DB::table('claims')->sum('claim_amount');                
            }else if ($role == 'User'){
                $all_users = User::all();
            $total_users = DB::table('users')->count('id');
            $user_balance = DB::table('users')->sum('user_balance');
            $sum_processed = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'processed')->count('id');
            $sum_pending = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'pending')->count('id');
            $sum_approved = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'approved')->count('id');
            $sum_refused = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'refused')->count('id');
            $sum_processed_amount = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'processed')->sum('claim_amount');
            $sum_approved_amount = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'approved')->sum('claim_amount');
            $sum_refused_amount = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'refused')->sum('claim_amount');
            $sum_pending_amount = DB::table('claims')->where('claim_user' , Session::get('loginId'))->where('claim_status', 'pending')->sum('claim_amount');
            $sum_claims = DB::table('claims')->where('claim_user' , Session::get('loginId'))->count('id');
            $sum_claims_amount = DB::table('claims')->where('claim_user' , Session::get('loginId'))->sum('claim_amount');                
                $claims = Claim::orderBy('id', 'desc')->where('claim_user' , Session::get('loginId'))->paginate(15);
            }


            //dd($claims);
            $data =  compact('claims','search', 'sum_processed', 'sum_claims','sum_claims_amount', 'sum_processed_amount', 'sum_pending', 'sum_processed_amount', 'sum_pending_amount', 'sum_approved' ,'sum_approved_amount', 'sum_refused','sum_refused_amount', 'total_users', 'user_balance','all_users');


            return view ('dashboard')->with($data);
        }
    }
    public function search_claim(Request $request){
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%.")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $user = User::orderBy('id')->paginate(10);
            $data =  compact('claims','search', 'user');
            return view ('claims.search')->with($data);
        }  
    }
    
    public function logout () {
    	if(Session::has('loginId')){
    		Session::pull('loginId');
    		return redirect('/');
    	}
    }
    public function all_users (Request $request){
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%.")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $user = User::orderBy('id')->paginate(15);
            $data =  compact('claims','search', 'user');
            return view ('all_users')->with($data);
        }       
    }
    public function add_user (Request $request){

        $search = $searchrequest['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%.")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {
           
            $claims = Claim::orderBy('id', 'desc')->paginate(10);
            $data =  compact('claims','search');
            return view ("add_user")->with($data);          

        }               
    } 

    public function profile_setting (){
        return view ("underdev");
    } 
    public function notifications (){
        return view ("underdev");
    }
    public function bill_reports (){
        return view ("underdev");
    }    


    public function nav(Request $request){

        //$users = User::where('id', '=', Session::get('loginId'))->value('role');
        //$data =  compact('users');
        //dd($data);        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function view_user(Request $request, $id){

        $user = User::find($id);

        $data =  compact('user');

        return view ("add_balance")->with($data);
        
    }

    public function show_user(Request $request, $id){

        $user = User::find($id);

        $data =  compact('user');

        return view ("edit_user")->with($data);
        
    }

    public function update_existing_user (Request $request, $id){
       

        $user = User::find($id);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->full_ssn = $request->full_ssn;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->state = $user->state;
        $user->city = $user->city;
        $user->zipcode = $request->zipcode;
        $user->marital_status = $request->marital_status;
        $user->account_status = $request->account_status;
        $user->gender = $user->gender;
        $user->date_of_withdrawal = $user->date_of_withdrawal;
        $user->docs = '';
        $user->email = $user->email;       
        $res = $user->save();

        alert()->success('User Updated','User details has been updated!');

        return redirect("all_users"); 
  
    }        

    public function add_user_balance(Request $request, $id){

        $user = User::find($id);

        $amount = 10;

        $newbalance = $request->balance * ((100-$amount) / 100);

        $user->user_balance = $user->user_balance + $newbalance;

        $res = $user->save();

        alert()->success('Balance Added','User balance has been added');

        return redirect("all_users"); 
  
    }           

    public function state_fetch_city($state){
        $cities=City::where('state',$state)->get();
        return response()->json($cities);
    }                                     
}
