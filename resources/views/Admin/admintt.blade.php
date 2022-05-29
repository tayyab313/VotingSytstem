<div class="main_content">
            <div class="document_heading container-fluid d-flex justify-content-between mt-4">
                <p class="document_paragraph">{{ session()->get('election_name') }}</p>
                @if(session()->get('election_status') =='in-process')
                <a class="btn filter_btn mark_as_complete" data-id="{{ session()->get('electionId') }}"><i class="fa fa-solid fa-check"></i>
                    Mark as Complete</a>
                @endif
                @if(session()->get('election_status') =='completed')
                <a class="btn  btn-primary mark_as_process" data-id="{{ session()->get('electionId') }}"><i class="far fa fa-times-circle"></i>
                    Mark as In-process</a>
                @endif
            </div>
            <div class="container-fluid">
                <div class="container-fluid butons_div">
                    <a href="{{route('tables',session()->get('electionId'))}}" class="{{ Route::currentRouteName() == 'tables' ? 'active_tab':''  }} btn  tables_btn">Tables</a>
                    <a href="{{route('candidateElection',session()->get('electionId'))}}" class="{{ Route::currentRouteName() == 'candidateElection' ? 'active_tab':''  }} btn candidate_btn">Candidates</a>
                    <a href="{{route('PPElection',session()->get('electionId'))}}" class="{{ Route::currentRouteName() == 'PPElection' ? 'active_tab':''  }} btn political_party_btn">Political Parties</a>
                </div>
            </div>
</div>