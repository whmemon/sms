<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlotsRequest;
use App\Models\Members;
use App\Models\Plots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class PlotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plots = DB::select("select p.id,folio_number,plot_number, plot_type,m.name as member_name,m.cellphone,p.status
        from plots p left join members m on m.id =p.current_member_id");
        return view('plots.index',['plots'=>$plots]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlotsRequest $request)
    {
        $plot = new Plots();
        $plot->plot_number = $request->plot_number;
        $plot->plot_type = $request->plot_type;
        $plot->user_id = auth()->id();
        $plot->save();
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

        $plot = Plots::find($id);
        $plot = DB::table('plots as p')
        ->select("p.id","folio_number","plot_number", "plot_type","m.name as member_name","m.cellphone","citizenship_number")
        ->leftJoin('members as m', 'p.current_member_id', '=', 'm.id')
        ->where("p.id","=",$id)->get();

        return view('plots.edit',['plot'=>$plot[0]]);

    }

    /**
     * 0e the specified resource in storage.
     */
    public function update(Request $request)
    {

        $plot = Plots::findOrFail($request->id);
        $member = Members::where('citizenship_number', '=', $request->citizenship_number)->firstOrFail();

        $plot->current_member_id = $member->id;
        $plot->save();




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $plots = DB::table('plots as p')
        ->select("p.id","folio_number","plot_number", "plot_type","m.name as member_name","m.cellphone","p.status")
        ->leftJoin('members as m', 'p.current_member_id', '=', 'm.id');

    if(!empty($request->plot_number))
    {
        $plots->where('p.plot_number', '=', $request->plot_number);
    }
    if(!empty($request->plot_type))
    {
        $plots->where('p.plot_type', '=', $request->plot_type);
    }
    if(!empty($request->citizenship_number))
    {
        $plots->where('m.citizenship_number', '=', $request->citizenship_number);
    }
    if($request->posession_status == 2)
    {

        $plots->whereNull('p.current_member_id');
    }

    $plots = $plots->get();
    return view('plots.index',['plots'=>$plots]);
    }

    public function membersPlots (Request $request)
    {
        $plots = DB::select('SELECT COUNT(*) AS CNT,(
SELECT NAME
FROM members
WHERE citizenship_number=m.citizenship_number) AS MEMBER
FROM plots p
LEFT JOIN members m ON m.id =p.current_member_id
GROUP BY m.citizenship_number
ORDER BY COUNT(*) DESC');

        return view('plots.members_plots',['plots'=>$plots]);

    }

    public function Mark ($id)
    {
        $plot =   Plots::findOrFail( $id );

        return response()->json(['plot'=>$plot]);

    }

    public function markPost (Request $request)
    {
        $plot = Plots::findOrFail( $request->id );

        if($request->plot_tag == 0)
        {
            $plot->status = null;
        }else{
            $plot->status = $request->plot_tag;
        }
        $plot->save();
        return $plot;

    }

    public function defaulters (Request $request)
    {

$plots = DB::select("select p.id,folio_number,plot_number, plot_type,m.name as member_name,m.cellphone,status
from plots p
left join members m on m.id =p.current_member_id where p.status is not null");
        return view('plots.index',['plots'=>$plots]);
    }






}
