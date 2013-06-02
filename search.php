<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html;UTF-8"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="/css/bootstrap-modal.css"/>
<link type="text/css" rel="stylesheet" href="/bootstrap/css/bootstrap-responsive.min.css"/>
<link type="text/css" rel="stylesheet" href="/jquery/jquery-bootstrap/jquery-ui-1.8.16.custom.css"/>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="/jquery/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="/jquery/jquery.tools.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
<!--Javascript library api  for google-->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<!-- Javascript for this page specifically -->

<script type="text/javascript">
</script>

<title>How Do I</title>
</head>

<body>
<style type="text/css">
  body {
    padding-top: 20px;
    padding-bottom: 60px;
  }

  /* Custom container */
  .container {
    margin: 0 auto;
    max-width: 1000px;
  }
  .container > hr {
    margin: 60px 0;
  }

  /* Main marketing message and sign up button */
  .jumbotron {
    margin: 80px 0;
    text-align: center;
  }
  .jumbotron h1 {
    font-size: 100px;
    line-height: 1;
  }
  .jumbotron .lead {
    font-size: 24px;
    line-height: 1.25;
  }
  .jumbotron .btn {
    font-size: 21px;
    padding: 14px 24px;
  }

  /* Supporting marketing content */
  .marketing {
    margin: 60px 0;
  }
  .marketing p + h4 {
    margin-top: 28px;
  }


  /* Customize the navbar links to be fill the entire space of the .navbar */
  .navbar .navbar-inner {
    padding: 0;
  }
  .navbar .nav {
    margin: 0;
    display: table;
    width: 100%;
  }
  .navbar .nav li {
    display: table-cell;
    width: 1%;
    float: none;
  }
  .navbar .nav li a {
    font-weight: bold;
    text-align: center;
    border-left: 1px solid rgba(255,255,255,.75);
    border-right: 1px solid rgba(0,0,0,.1);
  }
  .navbar .nav li:first-child a {
    border-left: 0;
    border-radius: 3px 0 0 3px;
  }
  .navbar .nav li:last-child a {
    border-right: 0;
    border-radius: 0 3px 3px 0;
  }
</style>

<?php
$county = $_POST['county'];
$state = $_POST['state'];
?>

<script language="javascript">

function renderDataDisplay(divId,action,title){

    var url = "http://censuslink.herokuapp.com/censuslink.php";
    var requestdata = "county=<?php echo $county; ?>&state=<?php echo $state; ?>&action=";
    
    $.ajax({
            type: "GET",
            url: url,
            dataType: "jsonp",
            data: requestdata+action,
            success: function (data) {        
                //displayAttr = {divId:divId,chartType:'bar',chartTitle:title};        
                //displayData(displayAttr,data);
                alert('make call to visualizations');
            },
            error: function (data) {
                alert('call went wrong');
            }
    });

}

$(function () {   
    renderDataDisplay("incomeChart","getIncomeByCounty","Income By County");
    //renderDataDisplay("educationChart","getEducationByCounty","Education Level By County");
    //renderDataDisplay("raceEthnicityChart","getRaceEthnicityByCounty","Race Ethnicity By County");    
});

</script>

<div class="container">

      <div class="masthead">
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>                
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>
      <div class="row-fluid">
        <div class="span6">
          <h2>Income</h2>
          <div class="incomeChart">
            Put an income chart
          </div>         
        </div> 
        <div class="span6">
          <h2>Education</h2>
          <div class="educationChart">
            Put an education chart
          </div>
        </div> 
      </div>
      <div class="row-fluid">
        <div class="span12" >
          <h2>Race and Ethnicity</h2>
          <div class="raceEthnicityChart">
            Put an education chart
          </div>
        </div> 
      </div>      
      <hr>
</div>

</body></html>