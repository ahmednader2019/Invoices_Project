<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 350, 'height' => 200])
        ->labels(['Half Paid Invoices', 'Paid Invoices' , 'Unpaid Invoices' ])
        ->datasets([
            [
                "label" => "Unpaid Invoices ",
                'backgroundColor' => ['#ec5858'],
                'data' => [30]
            ],
            [
                "label" => "Paid Invoices",
                'backgroundColor' => ['#81b214'],
                'data' => [20]
            ],
            [
                "label" => "Half Paid Invoices ",
                'backgroundColor' => ['#ff9642'],
                'data' => [30]
            ],

        ])
        ->options([]);
return view('dashboard', compact('chartjs'));

        return view('dashboard', compact('chartjs'));
 }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
