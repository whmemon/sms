<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'citizenship_number' => ['required','string',  'max:255', 'unique:members'],
        ]);
    }
    public function index()
    {
        $members = DB::select("select * from members order by citizenship_number asc");
        return view('members.index',['members'=>$members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        //dd($request->all());
        $member = new Members();
        $member->user_id = Auth::id();
        $member->name = $request->name;
        $member->father_name = $request->father_name;
        $member->kin = $request->kin;
        $member->citizenship_number = $request->citizenship_number;
        $member->cellphone = $request->cellphone;
        $member->email = $request->email;
        $member->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $member = Members::find($id);
        return view('members.edit',['member'=>$member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Members::find($id);
        $member->delete();
        return Redirect::route('members.index');
    }
}
