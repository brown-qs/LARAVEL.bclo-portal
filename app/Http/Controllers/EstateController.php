<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Payment;
use App\Credit;
use Session;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userid = Auth::id();
        $landlords = Estate::where('user_id', $userid)->paginate(2);
        return view('estates.index')->with('landlords', $landlords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('estates.create');
    }

    public function mark_paid_payment(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->is_paid = 1;
        $payment->save();

        $estate = $payment->estate;
        $estate->balance = $estate->balance + $payment->amount;
        $estate->save();

        return redirect()->route('frontend.singlehouse', ["id" => $estate->id]);
    }

    public function search(Request $request)
    {
        $keyword = '';
        if ($request->has('word')) $keyword = $request->word;
        $houses = Estate::where('address', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like', '%' . $keyword . '%')
            ->orWhere('land_id', 'like', '%' . $keyword . '%')
            ->orWhere(DB::raw("CONCAT(primary_first_name, ' ', primary_last_name)"), 'like', '%' . $keyword . '%')
            ->orWhere(DB::raw("CONCAT(secondary_first_name, ' ', secondary_last_name)"), 'like', '%' . $keyword . '%')
            ->paginate(7);
        return view('visitorsdashboard')
            ->with('search', $keyword)
            ->with('houses', $houses)
            ->with('count_total', Estate::count())
            ->with('count_no_paid', Estate::where('is_paid', 0)->count())
            ->with('count_paid', Estate::where('is_paid', 1)->count())
            ->with('count_no_mailbox', Estate::where('has_mailbox', 0)->count());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'is_paid' => 'required',
            'land_id' => 'required',
            'has_mailbox' => 'required',
            'primary_first_name' => 'required',
            'primary_last_name' => 'required',
            'address' => 'required',
        ]);

        if (Estate::where('land_id', $request->land_id)->exists()) {
            Session::flash('warning', 'This Profile already exist in the database');
            return redirect()->back();
        } else {
            // $featured = $request->picture;
            // $featured_new_name = time().$featured->getClientOriginalName();
            // $featured->move('uploads/images', $featured_new_name);

            $save = Estate::create([
                'user_id' => Auth::id(),
                'land_id' => $request->land_id,
                'is_paid' => $request->is_paid,
                'has_mailbox' => $request->has_mailbox,
                'phone' => $request->phone,
                'email' => $request->email,
                'primary_first_name' =>  $request->primary_first_name,
                'primary_last_name' => $request->primary_last_name,
                'secondary_first_name' =>  $request->secondary_first_name,
                'secondary_last_name' => $request->secondary_last_name,
                'address' => $request->address,
                'mailing_address' => $request->mailing_address,
                'acres' => $request->acres,
                'yearly_dues' => $request->yearly_dues,
                'lots' => $request->lots,
            ]);

            Session::flash('success', 'Records successfully added');
            return redirect()->route('frontend.singlehouse', ["id" => $save->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $estate = Estate::find($id);
        return view('estates.edit')->with('estate', $estate);
    }

    public function create_payment($id)
    {
        $estate = Estate::find($id);
        return view('estates.payment')->with('estate', $estate);
    }
    public function store_payment(Request $request, $estate_id)
    {
        $this->validate($request, [
            'is_paid' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        // $featured = $request->picture;
        // $featured_new_name = time().$featured->getClientOriginalName();
        // $featured->move('uploads/images', $featured_new_name);

        $save = Payment::create([
            'estate_id' => $estate_id,
            'is_paid' => $request->is_paid,
            'date' => $request->date,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);
        if ($save->is_paid == 0) {
            $estate = $save->estate;
            $estate->balance -= $save->amount;
            $estate->save();
        }
        Session::flash('success', 'Records successfully added');
        return redirect()->route('frontend.singlehouse', ["id" => $estate_id]);
    }

    public function remove_payment($id)
    {
        $payment = Payment::find($id);
        if ($payment->is_paid == 0) {
            $estate = $payment->estate;
            $estate->balance -= $payment->amount;
            $estate->save();
        }
        $payment->delete();
        return redirect()->route('frontend.singlehouse', ["id" => $estate->id]);
    }

    public function store_credit(Request $request, $estate_id)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        // $featured = $request->picture;
        // $featured_new_name = time().$featured->getClientOriginalName();
        // $featured->move('uploads/images', $featured_new_name);

        $save = Credit::create([
            'estate_id' => $estate_id,
            'amount' => $request->amount,
        ]);
        $estate = Estate::find($estate_id);
        $estate->balance = $estate->balance - $request->amount;
        $estate->save();

        Session::flash('success', 'Credit successfully added');
        return redirect()->route('frontend.singlehouse', ["id" => $estate_id]);
    }

    public function remove_credit($id)
    {
        $credit = Credit::find($id);
        $estate = $credit->estate;
        $estate->balance += $credit->amount;
        $estate->save();
        $credit->delete();
        return redirect()->route('frontend.singlehouse', ["id" => $estate->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'is_paid' => 'required',
            'land_id' => 'required',
            'has_mailbox' => 'required',
            'primary_first_name' => 'required',
            'primary_last_name' => 'required',
            'address' => 'required',
        ]);

        $estate = Estate::find($id);

        $estate->land_id = $request->land_id;
        $estate->is_paid = $request->is_paid;
        $estate->has_mailbox = $request->has_mailbox;
        $estate->phone = $request->phone;
        $estate->email = $request->email;
        $estate->primary_first_name = $request->primary_first_name;
        $estate->primary_last_name = $request->primary_last_name;
        $estate->secondary_first_name = $request->secondary_first_name;
        $estate->secondary_last_name = $request->secondary_last_name;
        $estate->address = $request->address;
        $estate->mailing_address = $request->mailing_address;
        $estate->acres = $request->acres;
        $estate->yearly_dues = $request->yearly_dues;
        $estate->lots = $request->lots;

        $estate->save();


        Session::flash('success', 'Successfully Updated');
        return redirect()->route('frontend.singlehouse', ["id" => $id]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $estate = Estate::find($id);
        $estate->delete();
        Session::flash('warning', 'Estate removed successfully');
        return redirect()->back();
    }

    public function report($type)
    {
        $profiles = [];
        $report_title = '';
        if ($type == 'have_unpaid_payments') {
            $report_title = "Profiles that have un-paid payments";
            $profiles = Estate::whereExists(function ($query) {
                $query->select(DB::raw(1))->from('payments')
                    ->whereColumn('estates.id', 'payments.estate_id')
                    ->where('payments.is_paid', 0);
            })->get();
        } else if ($type == 'acc_requests') {
            $report_title = "Profiles that have at least 1 ACC requests";
            $profiles = Estate::whereExists(function ($query) {
                $query->select(DB::raw(1))->from('accrequests')
                    ->whereColumn('estates.id', 'accrequests.estate_id');
            })->get();
        } else if ($type == 'acres_less_1') {
            $report_title = "Profiles less than 1 acre";
            $profiles = Estate::where('acres', '<', 1)->get();
        } else if ($type == 'no_mailbox') {
            $report_title = "Profiles which have no mailbox";
            $profiles = Estate::where('has_mailbox', 0)->get();
        } else if ($type == 'no_mailing_address') {
            $report_title = "Profiles which have no mailing address";
            $profiles = Estate::whereNull('mailing_address')->get();
        } else if ($type == 'non_dues_paid') {
            $report_title = "Profiles that dues are not paid";
            $profiles = Estate::where('is_paid', 0)->get();
        }
        return view('estates.report')->with('report_title', $report_title)
            ->with('profiles', $profiles);
    }
}
