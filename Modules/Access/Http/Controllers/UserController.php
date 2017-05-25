<?php

namespace Modules\Access\Http\Controllers;

use App\AuditDrivers\MyCustomDriver;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Drivers\Database;
use OwenIt\Auditing\Events\Auditing;

class UserController extends Controller
{
    private $auditor;
    public function __construct(Database $auditor)
    {
        $this->auditor = $auditor;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('access::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('access::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        if(User::all()->count() > 1){
//            User::all()->last()->delete();
//        }
        $user = new User(['name'=> 'Jose','email'=>'junior@hotmail.com','password'=>Hash::make('123456')]);
        $user->save();

        event(new Auditing($user,$this->auditor));

        return response()->json(true);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('access::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('access::edit');
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
