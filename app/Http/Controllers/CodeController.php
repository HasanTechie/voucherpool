<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;
use App\Models\Offer;
use App\Models\Code;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CodeController extends Controller
{

    /*
     * Extra: For a given Email, return all his valid Voucher Codes with the Name of the Special Offer
     */
    public function listOfCodesByEmail($email)
    {

        $recipient = Recipient::where('email', $email)->first();

        if ($recipient) {

            $codes = $recipient->codes()
                ->join('offers', 'offers.id', '=', 'codes.offer_id')
                ->whereNull('codes.used_on')
                ->where('offers.expiry', '>=', Carbon::today())->get();

            foreach ($codes as $code) {
                $vcodes[] = [
                    'offer_name' => $code->Offer->name,
                    'code' => $code->code,
                    'discount' => number_format($code->Offer->discount),
                    'expiry' => $code->Offer->expiry->format('d-m-Y'),
                ];
            }

            if (isset($vcodes)) {

                return response()->json
                (
                    [
                        'code' => 200,
                        'message' => 'Successful',
                        'vouchers' => $vcodes
                    ], 200
                );
            } else {
                return response()->json
                (
                    [
                        'code' => 200,
                        'message' => 'No More Offers left for : ' . $recipient->email . '',
                    ], 200
                );
            }


        } else {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'Invalid email address.'
                ], 400);
        }
    }

    /*
     * Provide an endpoint, reachable via HTTP, which receives a Voucher Code and Email and validates
     * the Voucher Code. In Case it is valid, return the Percentage Discount and set the date of usage
     */

    public function codeActivationByEmailAndCode(Request $request)
    {

        $recipient = Recipient::where('email', $request->input('email'))->first();

        if (!$recipient) {
            return response()->json([
                'code' => 400,
                'message' => 'Invalid email address'
            ], 400);
        }

        $vCode = $recipient->codes()
            ->select(['codes.id', 'offers.discount'])
            ->join('offers', 'offers.id', '=', 'codes.offer_id')
            ->where('codes.code', $request->input('code'))
            ->whereNull('codes.used_on')
            ->where('offers.expiry', '>=', Carbon::today())
            ->first();

        if (!$vCode) {
            return response()->json([
                'code' => 400,
                'message' => 'Invalid code.'
            ], 400);
        }

        Code::where('id', $vCode->id)
            ->update(['used_on' => Carbon::now()]);

        return response()->json([
            'code' => 200,
            'message' => 'Successful',
            'discount' => number_format($vCode->discount, 2)
        ]);
    }

    /*
     * For a given Special Offer and an expiration date generate for each Recipient a Voucher Code
     */
    public function codeGeneration(Request $request)
    {

        $offer = new Offer([
            'name' => $request->input('offer_name'),
            'discount' => $request->input('discount'),
            'expiry' => Carbon::createFromFormat('d/m/Y', $request->input('expiry')),
        ]);

        $offer->save();

        $recipients = Recipient::get();

        $errors = 0;
        $vCode = [];

        foreach ($recipients as $recipient) {
            $vCode [] = [
                'offer_id' => $offer->id,
                'recipient_id' => $recipient->id,
                'code' => Str::random(8),
            ];
        }

        Code::insert($vCode);

        if ($errors == 0) {
            return response()->json([
                'code' => 200,
                'message' => 'Successfully added codes to recipients',
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
