@extends('layout.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($user) ? 'Update user' : 'Add user' }}</h3>
                        </div>
                        @if(isset($user))
                            <form id="user_form" data-url="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                        @else
                            <form id="user_form" data-url="{{ route('user.store') }}" enctype="multipart/form-data">
                        @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">user Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter user Name" value="{{ isset($user) ? $user->name : '' }}">
                                </div>
                                <div class="form-group">
                    <label for="company_id">Department</label>
                    <select class="form-control" id="department_id" name="department_id">
                    <option value="" > Select </option>

                      @foreach($departments as $department)
                          <option value="{{ $department->id }}" {{ isset($user) && $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="designation_id">Designation</label>
                    <select class="form-control" id="designation_id" name="designation_id">
                    <option value="" > Select </option>
                      @foreach($designations as $designation)
                          <option value="{{ $designation->id }}" {{ isset($user) && $user->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" value="{{ isset($user) ? $user->phone_number : '' }}">
                                </div>
                                <input type="hidden" id="user_id" name="user_id" value="{{ isset($user) ? encrypt($user->id)  : '' }}">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
