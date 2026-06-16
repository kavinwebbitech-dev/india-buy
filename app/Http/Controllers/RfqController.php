<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rfq;

class RfqController extends Controller
{
    //
    public function store(Request $request)
{
    if (!auth()->check()) {

        return response()->json([
            'status' => false,
            'login' => true,
            'message' => 'Please login to submit RFQ'
        ], 401);

    }

    $request->validate([
        'product_name'    => 'required',
        'category_id'     => 'required',
        'sub_category_id' => 'required',
        'quantity'        => 'required|numeric',
        'unit'            => 'required',
        'details'         => 'required',
    ]);
    // dd($request->all());
    $rfq = Rfq::create([
        'user_id'         => auth()->id(),
        'product_name'    => $request->product_name,
        'category_id'     => $request->category_id,
        'sub_category_id' => $request->sub_category_id,
        'quantity'        => $request->quantity,
        'unit'            => $request->unit,
        'details'         => $request->details,
    ]);

    return response()->json([
        'status'  => true,
        'message' => 'RFQ Submitted Successfully',
        'data'    => $rfq
    ]);
}

public function destroy($id)
{
    $rfq = Rfq::find($id);

    if (!$rfq) {
        return response()->json([
            'status' => false,
            'message' => 'RFQ Not Found'
        ], 404);
    }

    $rfq->delete();

    return response()->json([
        'status' => true,
        'message' => 'RFQ Deleted Successfully'
    ]);
}

}
