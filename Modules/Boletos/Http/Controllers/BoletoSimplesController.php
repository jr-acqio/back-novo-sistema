<?php

namespace Modules\Boletos\Http\Controllers;

use BoletoSimples\BankBillet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class BoletoSimplesController extends Controller
{
    function __construct()
    {
        if(App::environment() == 'local') {
            \BoletoSimples::configure(array(
                "environment" => 'sandbox', // default: 'sandbox'
                "access_token" => 'c5a0c8d11c2e5c19284b9a6db338188f7dcbd15eb61152022ad9ffde0d8cb42e'
            ));
        }else{
            \BoletoSimples::configure(array(
                "environment" => 'production', // default: 'sandbox'
                "access_token" => 'd223192e8ed286b873208881f0e171693794803c33628729bd3141d612a005cd'
            ));
        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $bank_billets = \BoletoSimples\BankBillet::all(['page' => 1, 'per_page' => 250]);
        $billets = array();
        foreach($bank_billets as $bank_billet) {
            $billets[] = $bank_billet->attributes();
        }
        return response($billets, 200);
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
        // Criar um boleto
        $bank_billet = BankBillet::create(array (
            'amount' => $request->amount,
            'description' => $request->description,
            'expire_at' => $request->expire_at,
            'customer_address' => $request->customer_address,
            'customer_address_complement' => $request->customer_address_complement,
            'customer_address_number' => $request->customer_address_number,
            'customer_city_name' => $request->customer_city_name,
            'customer_cnpj_cpf' => $request->customer_cnpj_cpf,
            'customer_email' => $request->customer_email,
            'customer_neighborhood' => $request->customer_neighborhood,
            'customer_person_name' => $request->customer_person_name,
            'customer_person_type' => 'individual',
            'customer_phone_number' => $this->formatarTelefone($request->customer_phone_number),
            'customer_state' => $request->customer_state,
            'customer_zipcode' => $request->customer_zipcode
        ));
        if($bank_billet->isPersisted()){
            return response()->json($bank_billet->attributes());
        }
        return response()->json($bank_billet->response_errors, 422);
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

    private function formatarTelefone($telefone)
    {
        $telefone = str_replace('(', '', $telefone);
        $telefone = str_replace(')', '', $telefone);
        $telefone = str_replace(' ', '', $telefone);
        return $telefone;
    }
}
