<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;
use Carbon\Carbon;

class CodeController extends Controller
{

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

            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Successful',
                    'vouchers' => $vcodes
                ], 200);

        } else {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'Invalid email address.'
                ], 400);
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
