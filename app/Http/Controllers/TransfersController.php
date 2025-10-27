<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransferRequest;
use App\Models\Members;
use App\Models\Plots;
use App\Models\Transfers;
use BaconQrCode\Encoder\QrCode as EncoderQrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $transfers = DB::select("SELECT t.id,mtre.name transferee_name ,mtor.name transferor_name ,p.plot_type,p.plot_number,t.created_at,DATE_FORMAT(t.created_at, '%d %M, %Y') AS transfer_date
         FROM plot_transfers t
                    LEFT JOIN members mtre ON mtre.id= t.plot_transferor_id
                    LEFT JOIN members mtor ON mtor.id= t.plot_transferee_id
                    INNER JOIN plots p ON p.id= t.plot_id");
        return view('transfers.index',['transfers'=>$transfers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transfers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransferRequest $request)
    {

        $transfer = new Transfers();
        $member_transferor = Members::where('citizenship_number', '=', $request->citizenship_number)->firstOrFail();


        $plot = Plots::where('plot_number', '=', $request->plot_number)
            ->where('plot_type', '=', $request->plot_type)
        ->firstOrFail();
        $first_transfer_id = null;
        DB::beginTransaction();

        try {
                $ref_number = $this->generateReferenceNumber();
            for($i=0; $i<sizeof($request->transferee_cnic); $i++)
            {
                $transfer = new Transfers();
                $transfer->user_id = Auth::id();
                $transfer->reference_number = $ref_number;
                $transfer->plot_transferor_id = $member_transferor->id;
                $transfer->plot_id = $plot->id;
                $member_transferee = Members::where('citizenship_number', '=', $request->transferee_cnic[$i])->firstOrFail();
                $transfer->plot_transferee_id = $member_transferee->id;
                $transfer->parent_id = $first_transfer_id;
                $transfer->save();
                $first_transfer_id = $transfer->id;
            }
            DB::commit();
        } catch (\Exception $e) {
            // If there’s an error, roll back all changes
            DB::rollBack();

            // Optionally, you can log the error or return a custom message
            return response()->json(['error' => 'Transaction failed'], 500);
        }





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
        //
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
        //
    }

    public function pdf(string $id)
    {
        $transfer = DB::select("SELECT t.id,mtre.name transferee_name,mtre.citizenship_number transfaree_citizenship_no,mtre.address AS transferee_address,
mtre.district AS transferee_district,mtor.name transferor_name,
mtor.citizenship_number transferor_citizenship_no,p.plot_type,p.plot_number,t.created_at,DATE_FORMAT(t.created_at, '%d %M, %Y') AS transfer_date,reference_number
FROM plot_transfers t
LEFT JOIN members mtre ON mtre.id= t.plot_transferee_id
LEFT JOIN members mtor ON mtor.id= t.plot_transferor_id
INNER JOIN plots p ON p.id= t.plot_id
                    where t.id= $id or t.parent_id=$id");
                    //dd($transfer);
                    $a=0;
                    for($a=0; $a<sizeof($transfer); $a++)
                    {
                            $transferees[$a]['transferee_name'] = $transfer[$a]->transferee_name;
                            $transferees[$a]['transferee_citizenshipno'] = $transfer[$a]->transfaree_citizenship_no;
                            $transferees[$a]['transferor_citizenshipno'] = $transfer[$a]->transferor_citizenship_no;
                            $transferees[$a]['transferee_address'] = $transfer[$a]->transferee_address;
                            $transferees[$a]['transferee_district'] = $transfer[$a]->transferee_district;

                    }
                    //dd($transferees);

    //dd($transferees);
    $data = [
            'TRANSFER_DATE' => $transfer[0]->transfer_date,
            'REF_NO' => '012021',
            'transferees'=>$transferees,
            'EFFECTIVE_DATE'=>$transfer[0]->created_at,
            'PLOT_TYPE'=> $transfer[0]->plot_type,
            'PLOT_NO' => $transfer[0]->plot_number,
            'SOCIETY_NAME' => 'Pakistan Post Office Workers Cooperative Housing Society Limited Karachi',
            'SOCIETY_ADDRESS_LINE1' => 'Sector 36-A Scheme 33 Karachi',
            'SOCIETY_PHONE' => '+923332832835',
            'SOCIETY_EMAIL' => 'info@ppowchs.org.pk',
            'SOCIETY_REG_NO' => '811',
            'REFERENCE_NUMBER'=>$transfer[0]->reference_number

        ];



        $path = public_path('qrcode/'.$id.'.png');


     $qrCode = QrCode::size(300)->generate($transfer[0]->reference_number,'qrcode/'.$transfer[0]->reference_number.'.svg');

    $pdf = Pdf::loadView('pdf-templates.transfer-sale', $data, compact('qrCode'));

    return $pdf->download($id.'-transfer.pdf');

    }

    function generateReferenceNumber() {

        $max_refno = DB::select("SELECT MAX(reference_number) AS CURRENT_REFNO FROM plot_transfers");

        // If no reference number exists in the database, start from 1
        if (empty($max_refno) || is_null($max_refno[0]->CURRENT_REFNO)) {
            $ref_counter = 0;
        } else {
            // Extract the numeric part of the reference number (removing last 4 digits)
            $ref_counter = substr($max_refno[0]->CURRENT_REFNO, 0, -4);
        }

        // Increment the reference counter for the new reference number
        $ref_counter++;

        // Get the current year
        $currentYear = date("Y");

        // Generate the reference number
        $referenceNumber = $ref_counter .  $currentYear;
        return $referenceNumber;
    }
}
