<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Access\Contracts\RoleRepository;
use OwenIt\Auditing\Drivers\Database;
use OwenIt\Auditing\Events\Auditing;
use Prettus\Validator\Exceptions\ValidatorException;

class RoleController extends Controller
{
    private $repository;
    private $auditor;
    function __construct(RoleRepository $repository, Database $auditor)
    {
        $this->repository = $repository;
        $this->auditor = $auditor;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->repository->with('perms')->all();
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
        try{
            if($role = $this->repository->create($request->all())){
                event(new Auditing($role,$this->auditor));
                return response()->json($role ,200);
            }
        }catch (ValidatorException $e){
            return response()->json($e->getMessageBag(),422);
        }
        catch (\Exception $e){
            return response()->json($e->getMessage(),400);
        }
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
