<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html;UTF-8"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="http://bootswatch.com/flatly/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap-modal.css"/>
<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css"/>
<link type="text/css" rel="stylesheet" href="jquery/jquery-bootstrap/jquery-ui-1.8.16.custom.css"/>
<link href="http://bootswatch.com/css/bootswatch.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="jquery/jquery.tools.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/renderCharts.js"></script>
<script type="text/javascript" src="js/wikiSearch.js"></script>
<script type="text/javascript" src="js/twitterSearch.js"></script>

<!--Javascript library api  for google-->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<!-- Javascript for this page specifically -->

<script type="text/javascript">
</script>

<title>Small Biz How Do I</title>
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
$countyName = $_POST['countyName'];
$stateName = $_POST['stateName'];
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
                var txtMetaData = { "divId" : divId, "chartType"  : "pie" , "chartTitle" : title};               
                displayData(txtMetaData,data);
            },
            error: function (data) {
                $('#'+divId).text('Unable to display visualization');
            }
    });
    
    

}


function renderSearchContent(){
    var stateName = '<?php echo $stateName; ?>';
    var countyName = '<?php echo $countyName; ?>';
    wikiSearch(stateName,"regionHeader","regionInfo");
    twitterSearch(countyName,"twitterHeader","twitterInfo");    
}

$(function () {   
    
    renderSearchContent();
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
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>
      <div class="row-fluid">      
       <div class="span12">
           <div class="span6">
           <h2>Region Information</h2>           
           <div class="well">
            <h3 id="regionHeader"></h3>
            <div id="regionInfo">
            <i class="icon-spinner icon-spin icon-large"></i>Gathering regional information...
            </div>
           </div>           
           </div>
           <div class="span6">
           <h2>Community Talk</h2>
           <div class="well" id="communityTalk">
            <h3 id="twitterHeader"></h3>
            <div id="twitterInfo"><i class="icon-spinner icon-spin icon-large"></i>Collecting community chatter...</div>
            </div>
           </div>
       </div>
      </div> 
      <div class="row-fluid">
      <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                County Income Information
              </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
              <div class="accordion-inner">
                <div id="incomeChart">
                <i class="icon-spinner icon-spin icon-large"></i> Loading region income data...
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                County Education Information
              </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
              <div class="accordion-inner" id="educationChart">
                <i class="icon-spinner icon-spin icon-large"></i> Loading region Education data...
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                Race and Ethnicity Information
              </a>
            </div>
            <div id="collapseThree" class="accordion-body collapse">
              <div class="accordion-inner" id="raceEthnicityChart">
                <div id="raceEthnicityChart">
                <i class="icon-spinner icon-spin icon-large"></i> Loading Race and Ethnicity data...
                </div
              </div>
            </div>
          </div>
        </div>
        </div>
      <hr>
       <div class="footer">
        <p>&copy; Small Biz How Do I 2013</p>
      </div>
      
</div>

</body></html>