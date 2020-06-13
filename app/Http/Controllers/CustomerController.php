<?php
namespace App\Http\Controllers;

use App\Http\Requests\CrudValidation;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
      return view('customer');
    }

    public function getAll()
    {
        $factorSalaries = $this->customerService->getAll();

        return response()->json($factorSalaries);
    }

    public function show($id)
    {
        $dataCustomer = $this->customerService->findById($id);
        return response()->json(['data' => $dataCustomer], 200);
    }


    public function findById($id)
    {
        $dataCustomer = $this->customerService->findById($id);

        return response()->json($dataCustomer['data'], $dataCustomer['status']);
    }

    public function store(CrudValidation $request)
    {
        $dataCustomer = $this->customerService->create($request->all());

        return response()->json($dataCustomer['data'], $dataCustomer['status']);
    }

    public function update(CrudValidation $request, $id)
    {
        $dataCustomer = $this->customerService->update($request->all(), $id);

        return response()->json($dataCustomer['data'], $dataCustomer['status']);
    }

    public function destroy($id)
    {
        $dataCustomer = $this->customerService->destroy($id);

        return response()->json($dataCustomer['msg'], $dataCustomer['status']);
    }





}
