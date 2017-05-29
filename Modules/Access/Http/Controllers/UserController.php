<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mockery\Exception;
use Modules\Access\Contracts\UserRepository;
use Modules\Access\Entities\User;
use OwenIt\Auditing\Drivers\Database;
use OwenIt\Auditing\Events\Auditing;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{
    private $auditor;
    private $repository;
    public function __construct(Database $auditor, UserRepository $repository)
    {
        $this->auditor = $auditor;
        $this->repository = $repository;
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
        try{
            if($user = $this->repository->create($request->all())){
                event(new Auditing($user,$this->auditor));
                return response()->json('Usuário '. $user->name . ' registrado com sucesso!',200);
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
     * @param User $user
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try{
            if($userUpdated = $this->repository->update($request->all(), $id)){
                event(new Auditing($userUpdated,$this->auditor));
                return response()->json(['msg' => 'Usuário '. $userUpdated->name . ' Atualizado com sucesso!', 'user'=>$userUpdated],200);
            }
        }catch (ValidatorException $e){
            return response()->json($e->getMessageBag(),422);
        }
        catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
