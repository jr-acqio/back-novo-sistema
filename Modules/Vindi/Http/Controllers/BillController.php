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
    public function index(Request $request)
    {
//        dd($request->all());
        $bills = $this->bill->all([
            'sort_by'    => 'created_at',
            'sort_order' => 'desc',
            'per_page' => $request->length,
            'page' => $request->draw,
//            'query' => 'id:8779346'
        ]);
        return response()->json([
           'draw' => intval($request->draw),
            'recordsTotal' => intval($this->bill->getLastResponse()->getHeader('Total')[0]),
            'recordsFiltered' => intval($this->bill->getLastResponse()->getHeader('Total')[0]),
            'data' => $bills
        ]);
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
//        $bills = array();

        $bills = $this->bill->all([
            'sort_by'    => 'created_at',
            'sort_order' => 'desc',
            'per_page' => 50,
            'page' => 1,
            'query' => 'id:8779346'
        ]);
//        dd($this->bill->getLastResponse());
//        $max = ceil($this->bill->getLastResponse()->getHeader('Total')[0] / $this->bill->getLastResponse()->getHeader('Per-Page')[0]);
//        $i = 2;
//        while ($i <= $max) {
//            $bills = array_merge($bills, $this->bill->all([
//                'sort_by'    => 'created_at',
//                'sort_order' => 'desc',
//                'per_page' => 50,
//                'page' => $i
//            ]));
//            $i++;
//        }
        dd($bills);
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
