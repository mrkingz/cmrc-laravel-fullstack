<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Classes\VerificationCode;
use App\Http\Traits\VerificationTrait;
use App\Http\Traits\EmpericalDataOrderTrait;
use App\Http\Traits\PrecticalResearchOrderTrait;
use App\Http\Traits\EducationalServicesOrderTrait;

class OrderController extends Controller
{
    use OrderTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VerificationCode $verification)
    {
        $this->middleware('auth');

        $this->setVerificationCodeInstance($verification);
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
    public function create($type = null, $token = null)
    {
        return is_null($token) 
                ? $this->getOrderForm($type)
                : $this->getVerificationForm($token);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        $response = null;// $this->verification($request->only('code'));

        if (! is_null($response)) {
            return $response;
        }

        return  $this->saveOrder() 
            ? redirect($this->redirectPath()) 
            : redirect(route('new', ['type' => $type]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
