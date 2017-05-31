<?php

namespace Modules\Boletos\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Mockery\Exception;
use Modules\Boletos\Contracts\ConcilationRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class ConciliationController extends Controller
{
    use ValidatesRequests;
    private $repository;

    function __construct(ConcilationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('boletos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('boletos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'file' => 'required|mimetypes:text/plain'
            ],
            [
                'file.required'=>'Informe o arquivo a ser processado!',
                'file.mimetypes' => 'Informe um arquivo válido!'
            ]
        );
        try{
            return $this->repository->processReturn($request->all());

        }catch(ValidatorException $exception){
            return response()->json(['error'=>$exception->getMessageBag()],422);
        }
        catch(Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],400);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('boletos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('boletos::edit');
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
