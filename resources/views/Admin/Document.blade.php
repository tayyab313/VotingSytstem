@extends('layouts.main')

@section('content')

<div class="main_content">
    <div class="breadCrumbs">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li>Dashboard</li>
        </ul>
    </div>
    <div class="document_heading container-fluid d-flex justify-content-between">
        <p class="document_paragraph">Dashboard</p>

        <div class="btn-group">
            <button class="btn filter_btn mr-1" data-toggle="modal" data-target="#FIlterModal"><img src=<img src="{{asset('images/filter_icon.png')}}" class="filter_icon">>
                New Search</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius:4px">View Report
            </button>
            <div class="dropdown-menu menu_div">
                <a class="dropdown-item" href="#">Documents</a>
                <a class="dropdown-item" href="#">Disturbances</a>
                <a class="dropdown-item" href="#">Begining of Election</a>
                <a class="dropdown-item" href="#">Ending of Election</a>
                <a class="dropdown-item" href="#">Table with error</a>
            </div>
        </div>
    </div>
    <section>
        <div class="container-fluid splitting_div">
            <div class="row justify-centent-evenly">
                <div class="col-8">
                    <div class="container-fluid d-flex justify-content-between">
                        <p>Graficos</p>
                        <div>
                            <button class="btn  btn_group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-arrows-h" aria-hidden="true" ></i> Sort</button>
                           
                            <div class="dropdown-menu ">
                               <div class="cont">
                                   <input type="text" id="search_field" name="search_field">
                               <select class="form-select" id="selec" name="naem">
                                    <option selected>Open this select menu</option>
                                    <option value="candidate">Candidate Name</option>
                                    <option value="vote">Votes</option>
                                </select>
                               </div>
                                <a class="dropdown-item text-primary" href="#">+ Add another to sort</a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn_group clicked list_btn"><i class="fa fa-list" aria-hidden="true"></i> List</button>
                                <button type="button" class="btn btn_group chart_btn"><i class="fa fa-signal" aria-hidden="true"></i> Chart</button>
                            </div>
                        </div>
                    </div>
                    <div class="table_div container-fluid">

                        <table class="table list_table ">
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
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>
                                <tr>
                                    <th scope="row"><img src="{{asset('images/party_logo.png')}}"></th>
                                    <td>Partido Sociedad Patriotica 21 De Enero</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="d-flex mb-1">
                                                <img src="{{asset('images/tianiaPress.png')}}">Chance Geidt
                                            </div>
                                        </div>
                                    </td>
                                    <td>6:30 pm</td>
                                    <td>93%</td>
                                </tr>

                            </tbody>
                        </table>


                        <canvas id="line_graph" class="d-none"></canvas>
                    </div>
                </div>
                <div class="col-3">
                    <div class="container-fluid d-flex justify-content-between">
                        <h6>Documents</h6>
                    </div>
                    <div class="table_div container-fluid document_div">

                    <canvas id="document_chart"></canvas>


                    </div>


                    <div class="container-fluid d-flex justify-content-between">
                        <h6>Voters</h6>
                    </div>
                    <div class="table_div container-fluid voters_div" >

                        <canvas id="voters_chart"></canvas>


                    </div>




                    <div class="container-fluid d-flex justify-content-between">
                        <h6>Votes</h6>
                    </div>
                    <div class="table_div container-fluid  votes_div" >

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
                              <label for="table" class="">table</label>
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
    $('document').ready(()=>{
        $('.chart_btn').click(()=>{
            $.LoadingOverlay("show");
              setTimeout(function () {
                    $.LoadingOverlay("hide");
                    $('.list_table').toggleClass('d-none');
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
                data: [300, 50, 100],
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
                    text: 'Total : 5876',
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
                data: [100,300],
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
                    text: 'Total : 600',
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


    var config = {
        type: 'doughnut',
        data: {
            labels: [
                "Valid votes",
                "Blank votes",
                "Null votes"
            ],
            datasets: [{
                data: [300, 50, 100],
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
                    text: ' Total : 500',
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
    


// line graph satrt here


window.onload=function(){/*from w w w  .  j  a  v  a 2  s  .  c  o  m*/
var ctx = document.getElementById("line_graph");
Chart.pluginService.register({
    afterDraw: function(chart) {
        if (typeof chart.config.options.lineAt != 'undefined') {
           var lineAt = chart.config.options.lineAt;
            var ctxPlugin = chart.chart.ctx;
            var xAxe = chart.scales[chart.config.options.scales.xAxes[0].id];
            var yAxe = chart.scales[chart.config.options.scales.yAxes[0].id];
            if(yAxe.min != 0) return;
            ctxPlugin.strokeStyle = "red";
            ctxPlugin.beginPath();
            lineAt = (lineAt - yAxe.min) * (100 / yAxe.max);
            lineAt = (100 - lineAt) / 100 * (yAxe.height) + yAxe.top;
            ctxPlugin.moveTo(xAxe.left, lineAt);
            ctxPlugin.lineTo(xAxe.right, lineAt);
            ctxPlugin.stroke();
        }
    }
});
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["Omar", "Rayna", "Maren", "Ann", "Emerson", "Madelyn","Maria", "Marcus", "Jocelyn", "Marcus", "Mack", "cando","Marcus"],
        datasets: [{
            data: [12, 19, 3, 5, 20, 3,12, 19, 3, 5, 2, 13,9],
            backgroundColor: [
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#059CDC',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db'
            ],
            borderColor: [
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#059CDC',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db',
                '#dfe0db'
            ],
            borderWidth: 1
        }]
    },
    options: {
        lineAt: 14,
        scales: {
            xAxes: [{
                barPercentage:0.4,
                gridLines: {
                    display:false
                }
            }],
            yAxes: [{ gridLines: { display:false } }]
        }
    }
});
    }


</script>
@endsection('javascript')