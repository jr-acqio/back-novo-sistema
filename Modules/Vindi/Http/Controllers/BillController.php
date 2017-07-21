<?php

namespace Modules\Vindi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Vindi\Bill;

class BillController extends Controller
{

    private $bill;

    function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $bills = $this->bill->all([
            'sort_by'    => 'created_at',
            'sort_order' => 'desc',
            'query' => 'id:7953262'
//            'query' => 'customer_name_eq:Marcos'
        ]);
        dd($bills);
        dd($this->bill->getLastResponse());
        dd($this->bill->get(7953262));
        return dd($bills);
//        return view('vindi::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('vindi::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('vindi::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('vindi::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
