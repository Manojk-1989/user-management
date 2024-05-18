<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Http\Requests\UserRequest;
use App\Traits\ResponseTrait;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('department')->with('designation')->get();
            return DataTables::of($data)
            ->addColumn('encriptedId', function ($user) {
                return Crypt::encrypt($user->id);
            })
            ->addColumn('department_name', function ($user) {
                return $user->department ? $user->department->name : 'N/A';
            })
            ->addColumn('designation_name', function ($user) {
                return $user->designation ? $user->designation->name : 'N/A';
            })
            ->addColumn('created_at', function ($user) {
                return $formattedCreatedAt = $user->created_at->format('Y-m-d h:i A');
            })
            ->addColumn('updated_at', function ($user) {
                return $formattedCreatedAt = $user->updated_at->format('Y-m-d h:i A');
            })
            ->make(true);
        }
        $page = 'user-list';
        $pageTitle = 'Users List';
        return view('pages.user-list', compact('page', 'pageTitle')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get();
        $designations = Designation::get();
        $page = 'user';
        $pageTitle = 'Add User';
        return view('pages.user', compact('page', 'pageTitle', 'departments', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $user = new User($request->validated());
            $user->save();
            return $this->sendCreatedResponse('User added successfully');

        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Something went wrong');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $user = $user->findOrFail(Crypt::decrypt($id));
        $departments = Department::get();
        $designations = Designation::get();
        $page = 'user';
        $pageTitle = 'Add User';
    return view('pages.user', compact('user', 'page', 'pageTitle', 'departments', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user, $id)
    {
        try {
            $data = $request->validated();
            $user = $user->findOrFail(decrypt($id));
            $user->name = $data['name'];
            $user->department_id = $data['department_id'];
            $user->designation_id = $data['designation_id'];
            $user->phone_number = $data['phone_number'];
            $user->updated_at = now();
            $user->save();
            
            return $this->sendSuccessResponse('User updated successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
