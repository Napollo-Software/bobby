<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use Session;


class claimsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id', 'LIKE', "%$search%")->orwhere('claim_title', 'LIKE', "%$search%")->orwhere('claim_category', 'LIKE', "%$search%")->orwhere('claim_status', 'LIKE', "%$search%")->orwhere('claim_amount', 'LIKE', "%$search%")->orwhere('submission_date', 'LIKE', "%$search%")->get();
            $data = compact('claims', 'search');
            return view('claims.search')->with($data);

        } else {
            
            $role = User::where('id', '=', Session::get('loginId'))->value('role');
            //dd($role);

            if ($role == 'Admin'){
             $claims = Claim::orderBy('id', 'desc')->paginate(15);
             $all_users = User::all();
               
            }else if ($role == 'User'){
             
            $claims = Claim::orderBy('id', 'desc')->where('claim_user' , Session::get('loginId'))->paginate(15);
            $all_users = User::all();
            }            

           // $claims = Claim::orderBy('id', 'desc')->where('claim_user', Session::get('loginId'))->paginate(15);
            $data = compact('claims', 'search', 'all_users');
            return view('claims.claims', $data);


        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = User::all();
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id', 'LIKE', "%$search%")->orwhere('claim_title', 'LIKE', "%$search%")->orwhere('claim_category', 'LIKE', "%$search%")->orwhere('claim_status', 'LIKE', "%$search%")->orwhere('claim_amount', 'LIKE', "%$search%")->orwhere('submission_date', 'LIKE', "%$search%")->get();
            $data = compact('claims', 'search','users');
            return view('claims.search')->with($data);

        } else {

            $claims = Claim::orderBy('id', 'desc')->paginate(10);
            $data = compact('claims', 'search','users');
            return view('claims.add_claim', $data);

        }
        return view('claims.add_claim');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_date' => 'required',
            'claim_description' => 'required',
            'claim_category' => 'required',
            'claim_amount' => 'required',
            'claim_bill_attachment' => 'required',
            'payment_method' => 'required'
        ]);

        $current_balance = User::where('id', '=', Session::get('loginId'))->value('user_balance');

        if ($current_balance > $request->claim_amount) {
            $claim = new Claim();
            $claim->claim_title = $request->claim_title;
            $claim->expense_date = $request->expense_date;
            $claim->submission_date = $request->submission_date;
            $claim->claim_description = $request->claim_description;
            $claim->claim_category = $request->claim_category;
            $claim->claim_amount = $request->claim_amount;

            $attachment = $request['claim_bill_attachment']->getClientOriginalName();
            $request->claim_bill_attachment->move(public_path('/img'), $attachment);
            $claim->claim_bill_attachment=$attachment;


            $claim->payment_method = $request->payment_method;
            $claim->claim_status = 'Pending';
            $claim->refusal_reason = '';
            
            $role = User::where('id', '=', Session::get('loginId'))->value('role');
            
            if ($role == 'Admin'){
                $claim->claim_user = $request->claim_user;
            }else if ($role == 'User'){
                $claim->claim_user = User::where('id', '=', Session::get('loginId'))->value('id');
            }            
            
            //$claim->claim_user = User::where('id', '=', Session::get('loginId'))->value('id');
            //$claim->claim_user = $request->claim_user;
            $claim->save();

            $claimed_amount = $request->claim_amount;
            $new_balance = $current_balance - $claimed_amount;
            $user = User::find(Session::get('loginId'));
            $user->user_balance = $new_balance;
            $user->save();

            alert()->success('Claim Added', 'Your claim has been added successfully');

            return redirect('/claims');

        } else if ($current_balance < $request->claim_amount) {
            alert()->error('Insuffient Account Balance', 'Please request a deposit and try again.');
            return redirect('/claims');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id', 'LIKE', "%$search%")->orwhere('claim_title', 'LIKE', "%$search%")->orwhere('claim_category', 'LIKE', "%$search%")->orwhere('claim_status', 'LIKE', "%$search%")->orwhere('claim_amount', 'LIKE', "%$search%")->orwhere('submission_date', 'LIKE', "%$search%")->get();
            $data = compact('claims', 'search');
            return view('claims.search')->with($data);

        } else {

            $claim = Claim::find($id);
            $data = compact('claim', 'search');
            return view('claims.view')->with($data);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id', 'LIKE', "%$search%")->orwhere('claim_title', 'LIKE', "%$search%")->orwhere('claim_category', 'LIKE', "%$search%")->orwhere('claim_status', 'LIKE', "%$search%")->orwhere('claim_amount', 'LIKE', "%$search%")->orwhere('submission_date', 'LIKE', "%$search%")->get();
            $data = compact('claims', 'search');
            return view('claims.search')->with($data);

        } else {

            $claim = Claim::find($id);
            $data = compact('claim', 'search');
            return view('claims.edit')->with($data);

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'expense_date' => 'required',
            'claim_description' => 'required',
            'claim_category' => 'required',
            'claim_amount' => 'required',
            'payment_method' => 'required'
        ]);

        $claim = Claim::find($id);
        $claim->claim_title = $request->claim_title;
        $claim->expense_date = $request->expense_date;
        $claim->submission_date = $request->submission_date;
        $claim->claim_description = $request->claim_description;
        $claim->claim_category = $request->claim_category;
        $claim->claim_amount = $request->claim_amount;
        $claim->payment_method = $request->payment_method;
        $claim->claim_status = $request->claim_status;
        $claim->refusal_reason = $request->refusal_reason;


        if ( $request->claim_bill_attachment){
            $attachment = $request['claim_bill_attachment']->getClientOriginalName();
            $request->claim_bill_attachment->move(public_path('/img'), $attachment);
            $claim->claim_bill_attachment=$attachment;
        }

        $claim->claim_user = $claim->claim_user;
        $claim->save();

        alert()->success('Claim Updated', 'Your claim has been updated successfully');

        return redirect('/claims');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $claim = Claim::find($id);
        $claim->delete();
        alert()->success('Claim Deleted', 'Your claim has been deleted successfully');
        return redirect('/claims');
    }
}
