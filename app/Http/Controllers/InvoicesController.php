<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\products;
use App\Models\sections;
use App\Models\User;
use App\Notifications\Add_Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvoicesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Invoices', ['only' => ['index']]);
         $this->middleware('permission:Paid Invoices', ['only' => ['Invoice_Paid']]);
         $this->middleware('permission: Unpaid Invoices', ['only' => ['Invoice_Unpaid']]);
      //   $this->middleware('permission: half paid Invoices', ['only' => ['index']]);

        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
         $invoices = invoices::all();
         return view('invoices.invoices' , compact('invoices'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoice'  , compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
            $user =User::find(Auth::user()->id);

                $invoices = Invoices::latest()->first();
                Notification::send($user, new Add_Invoice($invoices));
                session()->flash('Add' , "Invoice Added Successfully");
                return redirect('invoices');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = invoices::findorFail($id);
        $sections = sections::all();
        $products = products::all();
        return view('invoices.status_show',compact('invoice','sections','products'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = invoices::findorFail($id);
        $sections = sections::all();
        $products = products::all();
        return view('invoices.edit_invoice',compact('invoice','sections','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $invoices = invoices::findorFail($request->invoice_id);
        try
        {
            $invoices->invoice_number = $request->invoice_number;
            $invoices->invoice_Date= $request->invoice_Date;
            $invoices->Due_date = $request->Due_date;
            $invoices->product = $request->product;
            $invoices->section_id= $request->Section;
            $invoices-> Amount_collection = $request->Amount_collection;
            $invoices-> Amount_Commission= $request->Amount_Commission;
            $invoices-> Discount = $request->Discount;
            $invoices->Value_VAT = $request->Value_VAT;
            $invoices->Rate_VAT = $request->Rate_VAT;
            $invoices-> Total = $request->Total;
            $invoices-> Status = 'غير مدفوعة';
            $invoices-> Value_Status = 2;
            $invoices-> note = $request->note;
            $invoices->save();
            return redirect('invoices');
        }
        catch(Exception $e){
         return redirect()->back()->withErrors(['error'=> $e->getMessage()]);
      }

        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $Details = invoices_attachments::where('invoice_id', $id)->first();
        if (!empty($Details->invoice_number)) {
            Storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
        }
        if($invoices==null)
            $invoices = invoices::onlyTrashed()->where('id',$id)->first();
            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function Status_Update(Request $request , $id)
    {
        $invoices = invoices::findOrFail($id);

        if ($request->Status === 'paid') {

            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_Details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoices_Details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');

    }
    public function Invoice_Paid()
    {
        $invoices = invoices::where('Value_Status',3)->get();
        return view('invoices.invoices_paid',compact('invoices'));
    }

    public function Invoice_Unpaid()
    {
        $invoices = invoices::where('Value_Status',3)->get();
        return view('invoices.invoices_unpaid',compact('invoices'));
    }
    public function restore($id)
    {
        $flight = Invoices::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/archieve');
    }
    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification){

         return $notification->data['title'];

        }
    }

    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }

}
