@extends('layout.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <form id="search_form" method="GET" action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Name / Department / Designation" name="search" id="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="row" id="department-content">
            </div>
        </div>
    </section>
@stop
