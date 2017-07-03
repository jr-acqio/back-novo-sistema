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
        return $this->repository->with('roles')->scopeQuery(function($query){
            return $query->withTrashed();
        })
            ->all();
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
                return response()->json($user,200);
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
            //Se tiver o parametro enabled = 1 irá reativar o usuário
            if($request->enabled) {
                $u = $this->repository->enabledUser($id);
                event(new Auditing($u,$this->auditor));
                return response()->json(['user'=>$u],200);
            }
            // Se chegar aqui é por que é atualização de dados
            if($userUpdated = $this->repository->update($request->all(), $id)){
                event(new Auditing($userUpdated,$this->auditor));
                return response()->json(['user'=>$this->repository->with('roles')->find($userUpdated->id)],200);
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
     * @param User $user
     * @return User
     */
    public function destroy($id)
    {
        try{
            $u = $this->repository->find($id);
            $u->delete();
            return $u;
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}