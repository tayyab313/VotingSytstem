@extends('layouts.main')



<!-- Main Content Here -->


@section('content')
<div class="main_content">
            <div class="document_heading container-fluid d-flex justify-content-between mt-4">
                <p class="document_paragraph">Election 2022</p>
                <button class="btn filter_btn mark_as_complete"><i class="fa fa-solid fa-check"></i>
                    Mark as Complete</button>
            </div>
            <div class="container-fluid">
                <div class="container-fluid butons_div">
                    <a class="btn active_btn tables_btn">Tables</a>
                    <a class="btn candidate_btn">Candidates</a>
                    <a class="btn political_party_btn">Political Parties</a>
                </div>
            </div>
            @yield('adminData')
</div>

@endsection('content')



