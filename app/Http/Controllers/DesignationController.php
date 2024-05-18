<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DesignationmentRequest;
use App\Traits\ResponseTrait;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Crypt;

class DesignationController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Designation::select('*');
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
        $page = 'designation';
        $pageTitle = 'Add Designation';
        return view('pages.designation', compact('page', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationmentRequest $request)
    {
        try {
            $designation = new Designation($request->validated());
            $designation->save();
            return $this->sendCreatedResponse('Color added successfully');

        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation, $id)
    {
        return $this->sendJsonResponse($designation->findOrFail(Crypt::decrypt($id))->toArray(), 200, 'Retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesignationmentRequest $request, Designation $designation, $id)
    {
        try {

            $data = $request->validated();
            $designation = $designation->findOrFail($id);
            $designation->name = $data['edit_name'];
            $designation->updated_at = now();
            $designation->save();
            
            return $this->sendSuccessResponse('Department updated successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
