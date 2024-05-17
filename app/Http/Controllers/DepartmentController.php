<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Traits\ResponseTrait;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Department::select('*');
            return DataTables::of($data)
            ->addColumn('encriptedId', function ($product) {
                return Crypt::encrypt($product->id);
            })
            ->addColumn('created_at', function ($product) {
                return $formattedCreatedAt = $product->created_at->format('Y-m-d h:i A');
            })
            ->addColumn('updated_at', function ($product) {
                return $formattedCreatedAt = $product->updated_at->format('Y-m-d h:i A');
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = 'department';
        $pageTitle = 'Add Department';
        return view('pages.department', compact('page', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            $color = new Department($request->validated());
            $color->save();
            return $this->sendCreatedResponse('Color added successfully');

        } catch (\Throwable $th) {dd($th);
            return $this->sendErrorResponse('Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department, $id)
    {
        return $this->sendJsonResponse($department->findOrFail(Crypt::decrypt($id))->toArray(), 200, 'Retrieved successfully');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department, $id)
    {
        try {

            $data = $request->validated();
            $department = $department->findOrFail($id);
            $department->name = $data['edit_name'];
            $department->updated_at = now();
            $department->save();
            
            return $this->sendSuccessResponse('Department updated successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
