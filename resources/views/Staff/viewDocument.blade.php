@extends('layouts.main')

@section('content')

<div class="main_content">
    <div class="breadCrumbs">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li>Result</li>
        </ul>
    </div>
    <section>
        <div class="container-fluid splitting_div">
            <div class="container-fluid">
                <h4 class="ml-2">Results</h4>
            </div>

            <div class="row justify-centent-evenly">
                <div class="col-6 cus_divStyle">
                    <div class="container-fluid d-flex justify-content-between">
                        <div>
                            <!-- <button class="btn  btn_group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-arrows-h" aria-hidden="true" ></i> Sort</button> -->
                           
                            <!-- <div class="dropdown-menu ">
                               <div class="cont">
                                   <input type="text" id="search_field" name="search_field">
                               <select class="form-select" id="selec" name="naem">
                                    <option selected>Open this select menu</option>
                                    <option value="candidate">Candidate Name</option>
                                    <option value="vote">Votes</option>
                                </select>
                               </div>
                                <a class="dropdown-item text-primary" href="#">+ Add another to sort</a>
                            </div> -->
                            <!-- <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn_group clicked list_btn"><i class="fa fa-list" aria-hidden="true"></i> List</button>
                                <button type="button" class="btn btn_group chart_btn"><i class="fa fa-signal" aria-hidden="true"></i> Chart</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="table_div container-fluid">
                        <embed src="{{asset('doc_images/'.$doc->file.'')}}" type="application/pdf" width="555px" height="500px"/>
                    </div>
                </div>
                <div class="col-6 cus_divStyle">
                    <div class="container-fluid d-flex justify-content-between">
                    </div>
                    <div class="table_div container-fluid document_div">
                        <h6>Alcalde</h6>
                        <div class="container">
                        <table class="table table-bordered" style=" border-radius: 25px !important;">
                            <thead>
                                <tr>
                                <th scope="col">Provincia</th>
                                <th scope="col" class="cus_p">{{$doc->provincia}}</th>
                                <th scope="col">Zona</th>
                                <th scope="col" class="cus_p">{{$doc->zona}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">Parroquia</th>
                                <td class="cus_p">{{$doc->parroquia}}</td>
                                <td>Circunscripcion</td>
                                <td class="cus_p">{{$doc->circun}}</td>
                                </tr>
                                <tr>
                                <th scope="row">Canton</th>
                                <td class="cus_p">{{$doc->canton}}</td>
                                <td>Junta No.</td>
                                <td class="cus_p">{{$doc->junta_no}}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="table_div container-fluid voters_div" >

                        <div class="row respoinsive_div">
                            <div class="total_Votes d-flex">
                                <img src="{{asset('images/totalVOtes.png')}}">
                                <div class="d-flex flex-column">
                                    <p  class="custom_style_p cus_p">Total Votes</p>
                                    <p class="custom_style_p">{{$doc->total_votes}}</p>
                                </div>

                            </div>
                            <div class="total_Votes d-flex">
                                <img src="{{asset('images/blue.png')}}">
                                <div class="d-flex flex-column">
                                    <p  class="custom_style_p cus_p">Valid votes</p>
                                    <p class="custom_style_p">{{$doc->valid_votes}} <span class="badge badge-bg">{{ceil(($doc->valid_votes/$doc->total_votes)*100)}}%</span></p>
                                    
                                </div>

                            </div>
                            <div class="total_Votes d-flex">
                                <img src="{{asset('images/yellow.png')}}">
                                <div class="d-flex flex-column">
                                    <p  class="custom_style_p cus_p">Null Votes</p>
                                    <p class="custom_style_p">{{$doc->null_votes}} <span class="badge badge-bg">{{ceil(($doc->null_votes/$doc->total_votes)*100)}}%</span></p>
                                </div>

                            </div>
                            <div class="total_Votes d-flex">
                                <img src="{{asset('images/orange.png')}}">
                                <div class="d-flex flex-column">
                                    <p  class="custom_style_p cus_p">Blank Votes</p>
                                    <p class="custom_style_p">{{$doc->blank_votes}} <span class="badge badge-bg">{{ceil(($doc->blank_votes/$doc->total_votes)*100)}}%</span></p>
                                </div>

                            </div>
                        </div>

                    </div>




                    
                    <div class="" >

                    <div class="table_div container-fluid">

                        <table class="table list_table ">
                            <thead class="table_head">
                                <tr>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Lista</th>
                                    <th scope="col">Candidates</th>
                                    <th scope="col">Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidates as $candidate)
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}" class="table_candidate_img"></th>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}" class="table_candidate_img">{{$candidate->candidate_name}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$candidate->candidate_votes}}</td>
                                </tr>
                                @endforeach   

                            </tbody>
                        </table>


                        <canvas id="line_graph" class="d-none"></canvas>
                    </div>


                    </div>
                </div>

            </div>
        </div>
</div>
</section>


</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="delete_modal modal-dialog modal-dialog-centered m-auto" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                <img src="{{asset('images/delete_pic.png')}}" class="delete_image">
                <p class="delete_text">Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary no_btn" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary comon_color_btn yes_btn">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- side modal -->

<div class="modal fade amk right from-right delay-200" id="FIlterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Filters</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body filter_body_modal">
                <div class="form_div w-100">
                  <form>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="Position" class="">Position</label>
                              <select id="Position" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="Provincia" class="">Provincia</label>
                              <select id="Provincia" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="Canton" class="">Canton</label>
                              <select id="Canton" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="Parroquia" class="">Parroquia</label>
                              <select id="Parroquia" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="Circumscripcion" class="">Circumscripcion</label>
                              <select id="Circumscripcion" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="Zone" class="">Zone</label>
                              <select id="Zone" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-12">
                              <label for="table" class="">Table</label>
                              <select id="table" class="form-control">
                                  <option selected>Choose...</option>
                                  <option>...</option>
                              </select>
                          </div>
                        </div>
                  </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary update_filter_btn btn-block">Update Filter</button>
            </div>
          </div>
        </div>
      </div>


      <!-- end here  -->
</div>

@endsection('content')

@section('javascript')
<script type="text/javascript">
</script>
@endsection('javascript')