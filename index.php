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
<!--Javascript library api  for google-->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>


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
    <script language="javascript">
    
    $(function () {  
        var keyIndex = 0;
        var questionArray = ["Learn the income of a particular market?","Discover more information about my customer base?","Find out information about potential business areas?"];
        var url = "http://censuslink.herokuapp.com/censuslink.php";
        
        function displayQuestion(){                            
                $("#questions").fadeOut(1000,function(){
                    $("#questions").html('<p class="lead">'+questionArray[keyIndex]+'</p>');
                    $("#questions").fadeIn(1000);
                });
                                
                if(keyIndex == questionArray.length - 1){
                    keyIndex = 0;           
                }
                else{keyIndex++;}
        }        

        function populateCounties(stateId,countyDivId){
        
            $.ajax({
            type: "GET",
            url: url,
            dataType: "jsonp",
            data: "action=getCountyList&state="+stateId,
            success: function (data) {        
                var options = '';
                $(data.censusLink[0].counties).each(function (row) {
                    if(this[0] != 'NAME')                    
                        options += '<option value="' + this[2] + '">' + this[0] + '</option>';
                });
                
                $('#'+countyDivId).html(options); 
                $('#'+countyDivId).removeAttr('disabled');
                
            },
            error: function (data) {
                
            } });    
        
        }
    
        function populateStates(stateId){        
            
            $.ajax({
            type: "GET",
            url: url,
            dataType: "jsonp",
            data: "action=getStateIdList",
            success: function (data) {        
                var options = '';
                $(data.censusLink[0].states).each(function (row) {
                    if(this[0] != 'NAME')                    
                        options += '<option value="' + this[1] + '">' + this[0] + '</option>';
                });
                
                $('#'+stateId).append(options);
                
                $('#'+stateId).live("change", function () {
                    populateCounties($(this).val(),'county');
                });
                
            },
            error: function (data) {
                
            } });
    
       }
        populateStates('state');
        setInterval(function(){displayQuestion();},3000);
        
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

      <!-- Jumbotron -->
    <div class="jumbotron">
        <h1>How Do I...</h1>
        <div id="questions"><p class="lead">Find out information about potential business areas?</p></div>
        <a href="#myModal" role="button" class="btn" data-toggle="modal">Start Here</a>
    </div>
   
   <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Research Business Regions</h3>
      </div>
      <div class="modal-body">
        <p>
        <form action="search.php" id="searchRegions" method="POST">
            <select name="state" id="state">
                <option value="NONE">Select a State</option>
            </select>
            <select name="county" id="county" disabled="true">               
            </select>
        </form>
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-primary" onclick="$('#searchRegions').submit();">Search Region</button>
      </div>
    </div>
      <hr>

      <div class="footer">
        <p>&copy; Small Biz How Do I 2013</p>
      </div>

    </div> <!-- /container -->
 
</body>
</html>
