<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentSourceRequest;
use App\Http\Requests\UpdatePaymentSourceRequest;
use App\Models\PaymentSource;

class PaymentSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePaymentSourceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentSource $paymentSource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentSource $paymentSource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentSourceRequest $request, PaymentSource $paymentSource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentSource $paymentSource)
    {
        //
    }
}
