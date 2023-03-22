<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchieveController extends Controller
{

    public function index()
    {
      $invoices = invoices::onlyTrashed()->get();
      return view('invoices.archieve',compact('invoices'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
       $invoice = invoices::findorFail($id);
       $invoice->Delete();
       session()->flash('delete_invoice');
       return redirect('/invoices');
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
    public function destroy(Request $request)
    {
            // $id = $request->id;
            // $invoices = invoices::where('id', $id)->first();
            //   $Details = invoices_attachments::where('invoice_id', $id)->first();
            // if (!empty($Details->invoice_number)) {
            //     Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
            // }
            // $invoices->forceDelete();
            // session()->flash('delete_invoice');
            // return redirect('/archieve');
    }

    public function restore($id)
    {
        $flight = Invoices::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/archieve');
    }
}
