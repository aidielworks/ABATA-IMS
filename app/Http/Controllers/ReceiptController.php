<?php

namespace App\Http\Controllers;

use App\Receipt;
use App\Receipt_Item;
use App\Student;
use Illuminate\Http\Request;
use PDF;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipt = Receipt::all();
        return view('Receipt.index', compact('receipt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('Receipt.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = $request->total_item;

        Receipt::create([
            'receipt_no' => $request->receipt_no,
            'receipt_date' => $request->receipt_date,
            'receipt_name' => $request->receipt_name,
            'receipt_receiver_ic' => $request->receiver_ic,
            'receipt_address' => $request->receipt_receiver_address,
            'receipt_total' => $request->receipt_final_amount,
            'receipt_issuedby' => session()->get('ic')
        ]);

        for ($i = 0; $i < $count; $i++) {
            # code...
            Receipt_Item::create([
                'receipt_no' => $request->receipt_no,
                'item_name' => $request->item_name[$i],
                'item_quantity' => $request->item_quantity[$i],
                'item_price' => $request->item_price[$i],
                'item_actual_amount' => $request->item_actual_amount[$i]
            ]);
        }

        return redirect("/admin/receipt")->with('status', 'Receipt inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        $receipt_items = Receipt_Item::where('receipt_no', $receipt->receipt_no)->get();
        return view('Receipt.show', compact('receipt', 'receipt_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        $receipt_items = Receipt_Item::where('receipt_no', $receipt->receipt_no)->get();
        return view('Receipt.edit', compact('receipt', 'receipt_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        $count = $request->total_item;

        Receipt::where('id', $receipt->id)->update([
            'receipt_total' => $request->receipt_final_amount
        ]);

        for ($i = 0; $i < $count; $i++) {
            Receipt_Item::where('id', $request->item_id[$i])->update([
                'item_name' => $request->item_name[$i],
                'item_quantity' => $request->item_quantity[$i],
                'item_price' => $request->item_price[$i],
                'item_actual_amount' => $request->item_actual_amount[$i]
            ]);
        }

        return redirect("/admin/receipt/$receipt->id")->with('status', 'Receipt updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }

    public function findAddress(Request $request)
    {
        $ic = $request->ic;

        $student = Student::where('ic', $ic)->get();

        $address = $student[0]['houseNo'] . ', ' . $student[0]['streetName'] . ', ' . $student[0]['city'] . ', ' . $student[0]['zipcode'] . ', ' . $student[0]['state'];
        $name = $student[0]['name'];

        $lastReceipt = Receipt::select('id')->latest('id')->first();
        if ($lastReceipt == '') {
            $lastID = 0;
        } else {
            $lastID = $lastReceipt->id;
        }

        return response()->json(['address' => $address, 'name' => $name, 'lastId' => $lastID]);
    }

    public function printReceipt(Receipt $receipt)
    {
        $receipt_items = Receipt_Item::where('receipt_no', $receipt->receipt_no)->get();
        $pdf = PDF::loadView('Receipt.printReceipt', compact('receipt', 'receipt_items'))->setPaper('a4', 'potrait');
        return $pdf->stream('ABATA - ' . $receipt->receipt_no . '.pdf', array("Attachment" => false));
    }
}
