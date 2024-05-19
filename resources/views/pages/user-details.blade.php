@extends('layout.layout')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">View User</h3>
                    </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name : {{ isset($user) ? $user->name : '' }}</label>
                            </div>
                            <div class="form-group">
                                <label for="department_id">Department : {{ isset($user) ? $user->department->name : '' }}</label>
                            </div>
                            <div class="form-group">
                                <label for="designation_id">Designation : {{ isset($user) ? $user->designation->name : '' }}</label>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number : {{ isset($user) ? $user->phone_number : '' }}</label>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
