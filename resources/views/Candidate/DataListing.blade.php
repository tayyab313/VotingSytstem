@extends('layouts.main')

@section('content')

<div class="main_content">
    <div class="breadCrumbs">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li>Dashboard</li>
        </ul>
    </div>
    <div class="document_heading container-fluid d-flex justify-content-between" id="listing_heading_button">
        <p class="document_paragraph">Dashboard</p>

        <div class="btn-group">
            <button class="btn filter_btn mr-1" data-toggle="modal" data-target="#FIlterModal">
                <i class="fa fa-filter mr-1" aria-hidden="true"></i>
                New Search</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius:4px">View Report
            </button>

            <div class="dropdown-menu menu_div">

            <form method="post" action="{{route('documentWithID')}}">
                @csrf
            @foreach($doc_ids_Arr as $doc_id)
                <input type="hidden" name="doc_id[]" value="{{ $doc_id }}">
            @endforeach
            <input type="hidden" name="Document" value="document">

            <input type="submit" class="dropdown-item" value="Documents" >
            </form>

            <form method="post" action="{{route('documentWithID')}}">
                @csrf
            @foreach($doc_ids_Arr as $doc_id)
                <input type="hidden" name="doc_id[]" value="{{ $doc_id }}">
            @endforeach
            <input type="hidden" name="Document" value="Disturbances">

            <input type="submit" class="dropdown-item" value="Disturbances" >
            </form>

            <form method="post" action="{{route('documentWithID')}}">
                @csrf
            @foreach($doc_ids_Arr as $doc_id)
                <input type="hidden" name="doc_id[]" value="{{ $doc_id }}">
            @endforeach
            <input type="hidden" name="Document" value="beginningOfElection">

            <input type="submit" class="dropdown-item" value="Beginning of Election" >
            </form>


            <form method="post" action="{{route('documentWithID')}}">
                @csrf
            @foreach($doc_ids_Arr as $doc_id)
                <input type="hidden" name="doc_id[]" value="{{ $doc_id }}">
            @endforeach
            <input type="hidden" name="Document" value="endingElection">

            <input type="submit" class="dropdown-item" value="Ending of Election" >
            </form>


            <form method="post" action="{{route('documentWithID')}}">
                @csrf
            @foreach($doc_ids_Arr as $doc_id)
                <input type="hidden" name="doc_id[]" value="{{ $doc_id }}">
            @endforeach
            <input type="hidden" name="Document" value="TableError">

            <input type="submit" class="dropdown-item" value="Table with Error" >
            </form>

                <!-- <a class="dropdown-item" href="#">Documents</a>
                <a class="dropdown-item" href="#">Disturbances</a>
                <a class="dropdown-item" href="#">Begining of Election</a>
                <a class="dropdown-item" href="#">Ending of Election</a>
                <a class="dropdown-item" href="#">Table with error</a> -->
            </div>
        </div>
    </div>
    <section class="mt-3">
        <div class="container-fluid splitting_div">
            <div class="row justify-centent-evenly">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    <div class="container-fluid d-flex justify-content-between">
                        <p>Graficos</p>
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
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn_group clicked list_btn"><i class="fa fa-list" aria-hidden="true"></i> List</button>
                                <button type="button" class="btn btn_group chart_btn"><i class="fa fa-signal" aria-hidden="true"></i> Chart</button>
                            </div>
                        </div>
                    </div>
                    <div class="table_div container-fluid">

                        <table class="table list_table " id="table_datatable">
                            <thead class="table_head">
                                <tr>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Name of Political Party</th>
                                    <th scope="col">Candidates</th>
                                    <th scope="col">Votos</th>
                                    <th scope="col">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_document_candidate as $candidate)
                                <tr>
                                    <th scope="row"><img src="{{asset('images/tianiaPress.png')}}" class="table_candidate_img"></th>
                                    <td>{{$candidate->political_party}}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}" class="table_candidate_img">{{$candidate->candidate_name}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$candidate->candidate_votes}}</td>
                                    <td>{{ceil(($candidate->candidate_votes/$total_votes)*100)}}%</td>
                                </tr>
                                @endforeach
                               

                            </tbody>
                        </table>


                        <div id="line_graph" class="d-none">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">
                            </p>
                        </figure>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12">
                    <div class="container-fluid d-flex justify-content-between" style="margin-top:11px;">
                        <h6>Documents</h6>
                    </div>
                    <div class="card container-fluid document_div">

                    <canvas id="document_chart"></canvas>


                    </div>


                    <div class="container-fluid d-flex justify-content-between">
                        <h6>Voters</h6>
                    </div>
                    <div class="card container-fluid voters_div" >

                        <canvas id="voters_chart"></canvas>


                    </div>




                    <div class="container-fluid d-flex justify-content-between">
                        <h6>Votes</h6>
                    </div>
                    <div class="card container-fluid  votes_div" >

                    <canvas id="votes_chart"></canvas>


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

<div class="modal fade amk right from-right delay-200" id="FIlterModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalTitle" aria-hidden="true">
  <div class="modal-dialog  modal-dialog modal-dialog-centered m-auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form_div w-100">
          <form id="filterForm">

            <div class="form-row">
              <div class="form-group col-12">
                <label for="provincia" class="">Provincia</label>
                <select id="provincia" name="provincia" class="form-control">
                  <option disabled selected>Choose...</option>
                  @foreach ($getSTatVal as $val)
                      <option value="{{$val['state_name']}}">{{$val['state_name']}}</option>
                      @endforeach
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="canton" class="">Canton</label>
                <select id="canton" name="canton" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="canto">Canto</option>
                  <option value="cantcao">Cantcao</option>
                  <option value="canto juanid">Canto juanid</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="parroquia" class="">Parroquia</label>
                <select id="parroquia" name="parroquia" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="parroquia">Parroquia</option>
                  <option value="parroqcacauia">Parroqcacauia</option>
                  <option value="parroquia junaid">Parroquia junaid</option>
                </select>
              </div>
            </div>
            <div class="form-row">
            <div class="form-group col-12">
                <label for="zona" class="">Zona</label>
                <select id="zona" name="zona" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="zona">Zona</option>
                  <option value="zoacna">zoacna</option>
                  <option value="zona junaid">Zona junaid</option>
                </select>
              </div>  
            </div>
            <div class="form-row">
            <div class="form-group col-12">
                <label for="circun" class="">Circunscripcion</label>
                <select id="circun" name="circun" class="form-control">
                  <option disabled selected>Choose...</option>
                  <option value="U">U</option>
                  <option value="R">R</option>
                  <option value="E">E</option>
                </select>
              </div> 
            
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="junta_no" class="">Junta No</label>
                <input type="number" class="form-control" id="junta_no" name="junta_no">

              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer d-block">
        <button type="button" class="btn btn-primary update_filter_btn w-50">Search</button>
        <button class="btn filter_btn " onClick="window.location.reload();"><i class="fas fa fa-sync"></i> Reset
        </button>
      </div>
    </div>
  </div>
</div>


      <!-- end here  -->
</div>

@endsection('content')

@section('javascript')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">
    $('document').ready(()=>{
        $('#table_datatable').DataTable({
      language: {
        searchPlaceholder: "Search Tables",
        search: ''
      }
    });

    var app = @json($doc_canidates_Arr);
    var graphData = @json($graphData);



        Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Election Votes'
    },
    xAxis: {
        categories: app,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Elections',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' votes'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    credits: {
        enabled: false
    },
    series: [{
        dataSorting: {
        enabled: true
    },
        name: 'Votes',
        data: [{{$graph_candidates_votes_array}}]
    }]
});

        $('.chart_btn').click(()=>{
            $.LoadingOverlay("show");
              setTimeout(function () {
                    $.LoadingOverlay("hide");
                    $('.list_table').toggleClass('d-none');
                    $('#table_datatable_wrapper').toggleClass('d-none');
                    $('#line_graph').toggleClass('d-none');
                    $('.list_btn').toggleClass('clicked');
                    $('.chart_btn').toggleClass('clicked');
              }, 2000);
            
        });
        $('.list_btn').click(()=>{
            $.LoadingOverlay("show");
              setTimeout(function () {
                    $.LoadingOverlay("hide");
                    $('.list_table').toggleClass('d-none');
                    $('#table_datatable_wrapper').toggleClass('d-none');
                    $('#line_graph').toggleClass('d-none');
                    $('.list_btn').toggleClass('clicked');
                    $('.chart_btn').toggleClass('clicked');
              }, 2000);
        });
    });
    Chart.pluginService.register({
        beforeDraw: function(chart) {
            if (chart.config.options.elements.center) {
                // Get ctx from string
                var ctx = chart.chart.ctx;

                // Get options from the center object in options
                var centerConfig = chart.config.options.elements.center;
                var fontStyle = centerConfig.fontStyle || 'Arial';
                var txt = centerConfig.text;
                var color = centerConfig.color || '#000';
                var maxFontSize = centerConfig.maxFontSize || 75;
                var sidePadding = centerConfig.sidePadding || 20;
                var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
                // Start with a base font of 30px
                ctx.font = "30px " + fontStyle;

                // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                var stringWidth = ctx.measureText(txt).width;
                var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

                // Find out how much the font can grow in width.
                var widthRatio = elementWidth / stringWidth;
                var newFontSize = Math.floor(30 * widthRatio);
                var elementHeight = (chart.innerRadius * 2);

                // Pick a new font size so it will not be larger than the height of label.
                var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
                var minFontSize = centerConfig.minFontSize;
                var lineHeight = centerConfig.lineHeight || 25;
                var wrapText = false;

                if (minFontSize === undefined) {
                    minFontSize = 20;
                }

                if (minFontSize && fontSizeToUse < minFontSize) {
                    fontSizeToUse = minFontSize;
                    wrapText = true;
                }

                // Set font settings to draw it correctly.
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                ctx.font = fontSizeToUse + "px " + fontStyle;
                ctx.fillStyle = color;

                if (!wrapText) {
                    ctx.fillText(txt, centerX, centerY);
                    return;
                }

                var words = txt.split(' ');
                var line = '';
                var lines = [];

                // Break words up into multiple lines if necessary
                for (var n = 0; n < words.length; n++) {
                    var testLine = line + words[n] + ' ';
                    var metrics = ctx.measureText(testLine);
                    var testWidth = metrics.width;
                    if (testWidth > elementWidth && n > 0) {
                        lines.push(line);
                        line = words[n] + ' ';
                    } else {
                        line = testLine;
                    }
                }

                // Move the center up depending on line height and number of lines
                centerY -= (lines.length / 2) * lineHeight;

                for (var n = 0; n < lines.length; n++) {
                    ctx.fillText(lines[n], centerX, centerY);
                    centerY += lineHeight;
                }
                //Draw text in center
                ctx.fillText(line, centerX, centerY);
            }
        }
    });


    var config = {
        type: 'doughnut',
        data: {
            labels: [
                "Valid docs",
                "In valid docs",
                "In process doc"
            ],
            datasets: [{
                data: [{{$valid_docs}}, {{$invalid_docs}}, 0],
                backgroundColor: [
                    "#07AAE9",
                    "#F59741",
                    "#FCD65C"
                ],
                hoverBackgroundColor: [
                    "#07AAE9",
                    "#F59741",
                    "#FCD65C"
                ]
            }]
        },
        options: {
            elements: {
                center: {
                    text: 'Total : {{$valid_docs + $invalid_docs}}',
                    color: '#000000', // Default is #000000
                    fontStyle: 'Arial', // Default is Arial
                    sidePadding: 20, // Default is 20 (as a percentage)
                    minFontSize: 10, // Default is 20 (in px), set to false and text will not wrap.
                    lineHeight: 25 // Default is 25 (in px), used for when text wraps
                }
            }
        }
    };

    var ctx = document.getElementById("document_chart").getContext("2d");
    var myChart = new Chart(ctx, config);




    // viter charts 
    Chart.pluginService.register({
        beforeDraw: function(chart) {
            if (chart.config.options.elements.center) {
                // Get ctx from string
                var ctx = chart.chart.ctx;

                // Get options from the center object in options
                var centerConfig = chart.config.options.elements.center;
                var fontStyle = centerConfig.fontStyle || 'Arial';
                var txt = centerConfig.text;
                var color = centerConfig.color || '#000';
                var maxFontSize = centerConfig.maxFontSize || 75;
                var sidePadding = centerConfig.sidePadding || 20;
                var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
                // Start with a base font of 30px
                ctx.font = "30px " + fontStyle;

                // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                var stringWidth = ctx.measureText(txt).width;
                var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

                // Find out how much the font can grow in width.
                var widthRatio = elementWidth / stringWidth;
                var newFontSize = Math.floor(30 * widthRatio);
                var elementHeight = (chart.innerRadius * 2);

                // Pick a new font size so it will not be larger than the height of label.
                var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
                var minFontSize = centerConfig.minFontSize;
                var lineHeight = centerConfig.lineHeight || 25;
                var wrapText = false;

                if (minFontSize === undefined) {
                    minFontSize = 20;
                }

                if (minFontSize && fontSizeToUse < minFontSize) {
                    fontSizeToUse = minFontSize;
                    wrapText = true;
                }

                // Set font settings to draw it correctly.
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                ctx.font = fontSizeToUse + "px " + fontStyle;
                ctx.fillStyle = color;

                if (!wrapText) {
                    ctx.fillText(txt, centerX, centerY);
                    return;
                }

                var words = txt.split(' ');
                var line = '';
                var lines = [];

                // Break words up into multiple lines if necessary
                for (var n = 0; n < words.length; n++) {
                    var testLine = line + words[n] + ' ';
                    var metrics = ctx.measureText(testLine);
                    var testWidth = metrics.width;
                    if (testWidth > elementWidth && n > 0) {
                        lines.push(line);
                        line = words[n] + ' ';
                    } else {
                        line = testLine;
                    }
                }

                // Move the center up depending on line height and number of lines
                centerY -= (lines.length / 2) * lineHeight;

                for (var n = 0; n < lines.length; n++) {
                    ctx.fillText(lines[n], centerX, centerY);
                    centerY += lineHeight;
                }
                //Draw text in center
                ctx.fillText(line, centerX, centerY);
            }
        }
    });


    var config = {
        type: 'doughnut',
        data: {
            labels: [
                "People Voted",
                "People not Voted"
            ],
            datasets: [{
                data: [{{$valid_votes}},{{$total_votes - $valid_votes}}],
                backgroundColor: [
                    "#FCD65C","#1AD4BF"
                ],
                hoverBackgroundColor: [
                    "#FCD65C","#1AD4BF"

                ]
            }]
        },
        options: {
            elements: {
                center: {
                    text: 'Total : {{$total_votes}}',
                    color: '#000000', // Default is #000000
                    fontStyle: 'Arial', // Default is Arial
                    sidePadding: 20, // Default is 20 (as a percentage)
                    minFontSize: 10, // Default is 20 (in px), set to false and text will not wrap.
                    lineHeight: 25 // Default is 25 (in px), used for when text wraps
                }
            }
        }
    };

    var ctx = document.getElementById("voters_chart").getContext("2d");
    var myChart = new Chart(ctx, config);


    // votes
    Chart.pluginService.register({
        beforeDraw: function(chart) {
            if (chart.config.options.elements.center) {
                // Get ctx from string
                var ctx = chart.chart.ctx;

                // Get options from the center object in options
                var centerConfig = chart.config.options.elements.center;
                var fontStyle = centerConfig.fontStyle || 'Arial';
                var txt = centerConfig.text;
                var color = centerConfig.color || '#000';
                var maxFontSize = centerConfig.maxFontSize || 75;
                var sidePadding = centerConfig.sidePadding || 20;
                var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
                // Start with a base font of 30px
                ctx.font = "30px " + fontStyle;

                // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                var stringWidth = ctx.measureText(txt).width;
                var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

                // Find out how much the font can grow in width.
                var widthRatio = elementWidth / stringWidth;
                var newFontSize = Math.floor(30 * widthRatio);
                var elementHeight = (chart.innerRadius * 2);

                // Pick a new font size so it will not be larger than the height of label.
                var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
                var minFontSize = centerConfig.minFontSize;
                var lineHeight = centerConfig.lineHeight || 25;
                var wrapText = false;

                if (minFontSize === undefined) {
                    minFontSize = 20;
                }

                if (minFontSize && fontSizeToUse < minFontSize) {
                    fontSizeToUse = minFontSize;
                    wrapText = true;
                }

                // Set font settings to draw it correctly.
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                ctx.font = fontSizeToUse + "px " + fontStyle;
                ctx.fillStyle = color;

                if (!wrapText) {
                    ctx.fillText(txt, centerX, centerY);
                    return;
                }

                var words = txt.split(' ');
                var line = '';
                var lines = [];

                // Break words up into multiple lines if necessary
                for (var n = 0; n < words.length; n++) {
                    var testLine = line + words[n] + ' ';
                    var metrics = ctx.measureText(testLine);
                    var testWidth = metrics.width;
                    if (testWidth > elementWidth && n > 0) {
                        lines.push(line);
                        line = words[n] + ' ';
                    } else {
                        line = testLine;
                    }
                }

                // Move the center up depending on line height and number of lines
                centerY -= (lines.length / 2) * lineHeight;

                for (var n = 0; n < lines.length; n++) {
                    ctx.fillText(lines[n], centerX, centerY);
                    centerY += lineHeight;
                }
                //Draw text in center
                ctx.fillText(line, centerX, centerY);
            }
        }
    });
    console.log({{$valid_votes}});

    var config = {
        type: 'doughnut',
        data: {
            labels: [
                "Valid votes",
                "Blank votes",
                "Null votes"
            ],
            datasets: [{
                data: [{{$valid_votes}}, {{$blank_votes}}, {{$null_votes}}],
                backgroundColor: [
                    "#07AAE9",
                    "#F59741",
                    "#FCD65C"
                ],
                hoverBackgroundColor: [
                    "#07AAE9",
                    "#F59741",
                    "#FCD65C"
                ]
            }]
        },
        options: {
            elements: {
                center: {
                    text: ' Total : {{ $total_votes }}',
                    color: '#000000', // Default is #000000
                    fontStyle: 'Arial', // Default is Arial
                    sidePadding: 20, // Default is 20 (as a percentage)
                    minFontSize: 10, // Default is 20 (in px), set to false and text will not wrap.
                    lineHeight: 25 // Default is 25 (in px), used for when text wraps
                }
            }
        }
    };

    var ctx = document.getElementById("votes_chart").getContext("2d");
    var myChart = new Chart(ctx, config);
    
    $('select[name="canton"],select[name="parroquia"],select[name="zona"],select[name="circun"],select[name="junta_no"]').attr('disabled','disabled');  
    console.log('sssasas');
    $('select[name=provincia]').on('change', function() {
      console.log('sss');
      var getValueOption = this.value;
      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getcityval')}}",
        data: {
          'getValueOption': getValueOption
        },
        success: function(result) {
          // $.LoadingOverlay("hide");
          html = "";
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.city_name +'">' + value.city_name +'</option>';
            });
            $('select[name=canton]').html(html);
            $('select[name=canton]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=canton]').on('change', function() {
      var getValuecity = this.value;
      var getValueState = $('select[name=provincia] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getparroquiaval')}}",
        data: {
          'getValuecity': getValuecity,
          'getValueState': getValueState,
        },
        success: function(result) {
          console.log(result);
           // $.LoadingOverlay("hide");
            html = "";
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.parroquia_name +'">' + value.parroquia_name +'</option>';
            });
            $('select[name=parroquia]').html(html);
            $('select[name=parroquia]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

    $('select[name=parroquia]').on('change', function() {
      var getValueparroquia = this.value;
      var getValueState = $('select[name=provincia] option:selected').val();
      var getValueCanton = $('select[name=canton] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getZonaValue')}}",
        data: {
          'getValuecity': getValueCanton,
          'getValueState': getValueState,
          'getValueparroquia': getValueparroquia,
        },
        success: function(result) {
           // $.LoadingOverlay("hide");
           console.log(result.data[0].zone_name);
           var html = "";
           if(result.data[0].zone_name == 'null' || result.data[0].zone_name == null)
           {
             console.log('inside if ');
            html = "<option  value='null'>Empty</option>";
            console.log(html);
            $('select[name=zona]').html(html);
           }
           else{
            $.each(result.data, function( index, value ) {
                html += '<option  value="'+ value.zone_name +'">' + value.zone_name +'</option>';
            });
            $('select[name=zona]').html(html);

           }

            $('select[name=zona]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });
    $('select[name=zona]').on('change', function() {
      $('select[name=circun]').removeAttr('disabled');

    });

    $('select[name=circun]').on('change', function() {
      var getValuecircun    = this.value;
      var getValueState     = $('select[name=provincia] option:selected').val();
      var getValueCanton    = $('select[name=canton] option:selected').val();
      var getValueparroquia = $('select[name=parroquia] option:selected').val();
      var getValuezona      = $('select[name=zona] option:selected').val();

      // $.LoadingOverlay("show");
      $.ajax({
        type: "POST",
        url: "{{ route('getJuntaValue')}}",
        data: {
          'getValuecircun': getValuecircun,
          'getValueState': getValueState,
          'getValueCanton': getValueCanton,
          'getValuezona': getValuezona,
          'getValueparroquia': getValueparroquia,
        },
        success: function(result) {
           // $.LoadingOverlay("hide");
           var femaleVoter = (result.data[0].female_voters) ?result.data[0].female_voters : null;
           var MaleVoter = result.data[0].male_voters;
           var html = "";
           for (let i = 1; i <= femaleVoter; i++) {
                html += '<option  value="'+ i+'F'+'">' + i+'F' +'</option>';
            }
            $('select[name=junta_no]').append(html);

          var Malehtml = "";
           for (let i = 1; i <= MaleVoter; i++) {
              Malehtml += '<option  value="'+ i+'M'+'">' + i+'M' +'</option>';
            }
            $('select[name=junta_no]').append(Malehtml);
            // $.each(result.data, function( index, value ) {
            // });
            $('select[name=junta_no]').removeAttr('disabled');


        },
        error: function() {
          alert("Error");
        }
      });
    });

// line graph satrt here


// window.onload=function(){/*from w w w  .  j  a  v  a 2  s  .  c  o  m*/
// var ctx = document.getElementById("line_graph");
// Chart.pluginService.register({
//     afterDraw: function(chart) {
//         if (typeof chart.config.options.lineAt != 'undefined') {
//            var lineAt = chart.config.options.lineAt;
//             var ctxPlugin = chart.chart.ctx;
//             var xAxe = chart.scales[chart.config.options.scales.xAxes[0].id];
//             var yAxe = chart.scales[chart.config.options.scales.yAxes[0].id];
//             if(yAxe.min != 0) return;
//             ctxPlugin.strokeStyle = "red";
//             ctxPlugin.beginPath();
//             lineAt = (lineAt - yAxe.min) * (100 / yAxe.max);
//             lineAt = (100 - lineAt) / 100 * (yAxe.height) + yAxe.top;
//             ctxPlugin.moveTo(xAxe.left, lineAt);
//             ctxPlugin.lineTo(xAxe.right, lineAt);
//             ctxPlugin.stroke();
//         }
//     }
// });
// var app = @json($doc_canidates_Arr);
// alert(app)
// var myChart = new Chart(ctx, {
//     type: 'horizontalBar',
//     data: {
//         labels: app,
//         datasets: [{
//             label:'Graficos',
//             data: [{{$graph_candidates_votes_array}}],
//             backgroundColor: [
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#059CDC',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db'
//             ],
//             borderColor: [
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#059CDC',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db',
//                 '#dfe0db'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         lineAt: 14,
//         scales: {
//             xAxes: [{
//                 barPercentage:0.4,
//                 gridLines: {
//                     display:false
//                 }
//             }],
//             yAxes: [{ gridLines: { display:false } }]
//         }
//     }
// });
//     }


</script>
@endsection('javascript')