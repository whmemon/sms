<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlotTransferVerificationController extends Controller
{


public function verify(Request $request)
{ 
    $validator = Validator::make(
        $request->all(),
        [
            'reference_number' => 'required|numeric'
        ],
        [
            'reference_number.required' => 'Reference number is required.',
            'reference_number.numeric'  => 'Reference number must contain digits only.'
        ]
    );

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    $transfer = DB::table('plot_transfers as pt')
    ->rightJoin('members as m', 'm.id', '=', 'pt.plot_transferee_id')
    ->rightJoin('plots as p', 'p.id', '=', 'pt.plot_id')
    ->where('pt.reference_number', $request->reference_number)
    ->select(
    'pt.reference_number',
    'pt.created_at as transfer_date',
    'p.plot_number',
    'p.folio_number',
    'm.name as transferee_name',
    'm.kin',
    'm.father_name as transferee_father_name',
    'm.husband_name as transferee_husband_name'
    )
    ->first();

    if (!$transfer) {
        return response()->json([
            'status'  => false,
            'message' => 'No record found against this reference number.'
        ], 404);
    }

    return response()->json([
        'status'  => true,
        'message' => 'Reference number verified successfully.',
        'data'    => $transfer
    ]);
}

}
