<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Accrequest;
use App\Estate;
use Auth;

class AccrequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //

    }

    public function allletters()
    {
        $comments = Accrequest::orderby('created_at', 'desc')->paginate(4);
        return view('accrequests.allcomments')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $estate = Estate::findOrFail($id);

        $comments = Accrequest::where('estate_id', $id)->orderby('created_at', 'desc')->paginate(3);
        return view('accrequests.create')->with('estate', $estate)
            ->with('comments', $comments);
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
            'note' => 'required',
            'file' => 'required',
        ]);

        $featured = $request->file;
        $featured_new_name = time() . $featured->getClientOriginalName();
        $featured->move('uploads/files', $featured_new_name);

        $addcomment = Accrequest::create([
            'user_id' => Auth::id(),
            'estate_id' => $request->id,
            'note' => $request->note,
            'file' => $featured_new_name,

        ]);

        Session::flash('success', 'Comment successfully added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comment = Accrequest::findOrFail($id);

        return view('accrequests.edit')->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'note' => 'required',
        ]);
        $comment = Accrequest::findOrFail($id);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $featured = $request->file;
            $featured_new_name = time() . $featured->getClientOriginalName();
            $featured->move('uploads/files', $featured_new_name);
            $comment->file = $featured_new_name;
        }
        $comment->note = $request->note;
        $comment->save();

        Session::flash('success', 'Update is successfully made');
        return redirect()->route('frontend.singlehouse', ["id" => $comment->estate_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Accrequest::findOrFail($id);
        $comment->delete();
        Session::flash('success', 'This Request is removed successfully');
        return redirect()->back();
    }
}
