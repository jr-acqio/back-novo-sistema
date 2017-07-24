<?php

namespace Modules\Vindi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Vindi\Subscription;

class SubscriptionController extends Controller
{
    private $subscriptions;

    function __construct(Subscription $subscription)
    {
        $this->subscriptions = $subscription;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $subscriptions = $this->subscriptions->all([
            'sort_by'    => 'created_at',
            'sort_order' => 'desc'
        ]);
        return $subscriptions;
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
