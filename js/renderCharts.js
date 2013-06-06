/*

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 */
/**
 * @package  JavaScript
 * @license  Apache License, Version 2.0
 * @author  Nigel Cruce

 */


////////////////////////////////////////////////////////////////////////
/**
  * Draw table using data objData_json
  * expects <div id="chart_div"></div>
  */
function drawTable(objData_json,objMetaData_json) {
  var arrData = new Array();

  for(var key in objData_json) {
    arrData.push(new Array(objData_json[key].title,parseInt( objData_json[key].quantity)) );
  }

  var data = new google.visualization.DataTable();
  var options = { title: '',showRowNumber: false, allowHtml: true };

  data.addColumn('string', 'Category');
  data.addColumn('number', 'Count');
  //data.setProperty(0, 0, 'style', 'width:25px');
  data.addRows(arrData.length);
  for(var i = 0; i < arrData.length; i++) {
    data.setCell(i, 0, arrData[i][0], arrData[i][0]);
    data.setCell(i, 1, arrData[i][1], arrData[i][1]);

  }

  var formatter = new google.visualization.NumberFormat( {fractionDigits: 0} );
  formatter.format(data, 1);

  var table = new google.visualization.Table(document.getElementById(objMetaData_json.divId_table));

  google.visualization.events.addListener(table, 'ready', function () {
    var title = 'Category';
    var width = '100px';
    $('.google-visualization-table-th:contains(' + title + ')').css('width', width);
    title = 'Count';
    width = '50px';
    $('.google-visualization-table-th:contains(' + title + ')').css('width', width);
  });

  table.draw(data, options);
}

////////////////////////////////////////////////////////////////////////
/**
  * Draw chart using data objData_json
  * expects <div id="table_div"></div>
  */
function drawChart(objData_json,objMetaData_json) {

  var arrData = new Array();

  for(var key in objData_json) {
    arrData.push(new Array(objData_json[key].title, parseInt(objData_json[key].quantity)));
  }

  var data = google.visualization.arrayToDataTable(arrData);
  
  var options = { title: objMetaData_json.chartTitle, allowHtml: true, width: 900, height: 500 };
  
  // account for smaller screens.
  if (screen.width < 900) {
    options = { title: objMetaData_json.chartTitle, allowHtml: true, width: screen.width, height: 500 };
  } 


  var chart;

  if( objMetaData_json.chartType == "pie" ) {
    chart = new google.visualization.PieChart(document.getElementById(objMetaData_json.divId));
  }
  else if( objMetaData_json.chartType == "bar" ) {
    // bug in bar and column charts on mobile device was causing an 'undefined error' when 
    // screen width is under 400. 
    chart = new google.visualization.BarChart(document.getElementById(objMetaData_json.divId));
  }
 
  chart.draw(data, options);
}


////////////////////////////////////////////////////////////////////////
/**
  * Draw chart using data objData_json
  * @tparam JSON    objMetaData_json_in  the format and display details
  * @tparam string  txtData_json         the data to be displayed, unparsed JSON
  */

 

 function displayData(objMetaData_json_in, objData_json_in) {

  var thisKey = objData_json_in["censusLink"]["keys"][0];
  var objData_json = objData_json_in["censusLink"][thisKey]["results"];
  var objMetaData_json = objMetaData_json_in;

  if( objMetaData_json.chartType != "table" ) {
   drawChart(objData_json,objMetaData_json);
  }
  if(objMetaData_json.divId_table != undefined){
   drawTable(objData_json,objMetaData_json);
  }

}

////////////////////////////////////////////////////////////////////////
/**
  * temporary
  */
function displayData_alt(txtMetaData_json, txtData_json) {
    var objMetaData_json_in = JSON.parse(txtMetaData_json);

    var objData_json_in = JSON.parse(txtData_json);

    displayData(objMetaData_json_in, objData_json_in);
}

////////////////////////////////////////////////////////////////////////
/**
  * demonstrate
  */
function exampleTest(txtMetaData_json, txtData_json) {

    var txtData_jsonA = '{  "_002E" : { "title" : "Less than $10,000   " , "quantity" : 31880 },  "_003E" : { "title" : "$10,000 to $14,999  " , "quantity" : 18130 },  "_004E" : { "title" : "$15,000 to $19,999  " , "quantity" : 15638 },  "_005E" : { "title" : "$20,000 to $24,999  " , "quantity" : 16369 },  "_006E" : { "title" : "$25,000 to $29,999  " , "quantity" : 15694 },  "_007E" : { "title" : "$30,000 to $34,999  " , "quantity" : 17698 },  "_008E" : { "title" : "$35,000 to $39,999  " , "quantity" : 15632 },  "_009E" : { "title" : "$40,000 to $44,999  " , "quantity" : 16647 },  "_010E" : { "title" : "$45,000 to $49,999  " , "quantity" : 12285 },  "_011E" : { "title" : "$50,000 to $59,999  " , "quantity" : 25852 },  "_012E" : { "title" : "$60,000 to $74,999  " , "quantity" : 31455 },  "_013E" : { "title" : "$75,000 to $99,999  " , "quantity" : 37448 },  "_014E" : { "title" : "$100,000 to $124,999" , "quantity" : 29482 },  "_015E" : { "title" : "$125,000 to $149,999" , "quantity" : 17489 },  "_016E" : { "title" : "$150,000 to $199,999" , "quantity" : 21996 },  "_017E" : { "title" : "$200,000 or more    " , "quantity" : 33768 } }';

    var txtData_jsonB1 = '{"censusLink":{"income":{"_001E":{"title":"Total","quantity":"357463"},"results":{"_002E":{"title":"Less than $10,000","quantity":"31880"},"_003E":{"title":"$10,000 to $14,999","quantity":"18130"},"_004E":{"title":"$15,000 to $19,999","quantity":"15638"},"_005E":{"title":"$20,000 to $24,999","quantity":"16369"},"_006E":{"title":"$25,000 to $29,999","quantity":"15694"},"_007E":{"title":"$30,000 to $34,999","quantity":"17698"},"_008E":{"title":"$35,000 to $39,999","quantity":"15632"},"_009E":{"title":"$40,000 to $44,999","quantity":"16647"},"_010E":{"title":"$45,000 to $49,999","quantity":"12285"},"_011E":{"title":"$50,000 to $59,999","quantity":"25852"},"_012E":{"title":"$60,000 to $74,999","quantity":"31455"},"_013E":{"title":"$75,000 to $99,999","quantity":"37448"},"_014E":{"title":"$100,000 to $124,999","quantity":"29482"},"_015E":{"title":"$125,000 to $149,999","quantity":"17489"},"_016E":{"title":"$150,000 to $199,999","quantity":"21996"},"_017E":{"title":"$200,000 or more","quantity":"33768"}}}}, {"keys" : ["income"] } }';

    var txtData_jsonB = '{"censusLink":{"income":{"_001E":{"title":"Total","quantity":"357463"},"results":{"_002E":{"title":"Less than $10,000","quantity":"31880"},"_003E":{"title":"$10,000 to $14,999","quantity":"18130"},"_004E":{"title":"$15,000 to $19,999","quantity":"15638"},"_005E":{"title":"$20,000 to $24,999","quantity":"16369"},"_006E":{"title":"$25,000 to $29,999","quantity":"15694"},"_007E":{"title":"$30,000 to $34,999","quantity":"17698"},"_008E":{"title":"$35,000 to $39,999","quantity":"15632"},"_009E":{"title":"$40,000 to $44,999","quantity":"16647"},"_010E":{"title":"$45,000 to $49,999","quantity":"12285"},"_011E":{"title":"$50,000 to $59,999","quantity":"25852"},"_012E":{"title":"$60,000 to $74,999","quantity":"31455"},"_013E":{"title":"$75,000 to $99,999","quantity":"37448"},"_014E":{"title":"$100,000 to $124,999","quantity":"29482"},"_015E":{"title":"$125,000 to $149,999","quantity":"17489"},"_016E":{"title":"$150,000 to $199,999","quantity":"21996"},"_017E":{"title":"$200,000 or more","quantity":"33768"}}},"keys":["income"]}}';

    var txtData_jsonC = '{ "_002E":{"title":"Less than $10,000","quantity":"31880"},"_003E":{"title":"$10,000 to $14,999","quantity":"18130"},"_004E":{"title":"$15,000 to $19,999","quantity":"15638"},"_005E":{"title":"$20,000 to $24,999","quantity":"16369"},"_006E":{"title":"$25,000 to $29,999","quantity":"15694"},"_007E":{"title":"$30,000 to $34,999","quantity":"17698"},"_008E":{"title":"$35,000 to $39,999","quantity":"15632"},"_009E":{"title":"$40,000 to $44,999","quantity":"16647"},"_010E":{"title":"$45,000 to $49,999","quantity":"12285"},"_011E":{"title":"$50,000 to $59,999","quantity":"25852"},"_012E":{"title":"$60,000 to $74,999","quantity":"31455"},"_013E":{"title":"$75,000 to $99,999","quantity":"37448"},"_014E":{"title":"$100,000 to $124,999","quantity":"29482"},"_015E":{"title":"$125,000 to $149,999","quantity":"17489"},"_016E":{"title":"$150,000 to $199,999","quantity":"21996"},"_017E":{"title":"$200,000 or more","quantity":"33768" }}';

    // Pie
    var txtMetaData_jsonA = '{ "divId" : "chart_div", "divId_table" : "table_div"  , "chartType"  : "pie" , "chartTitle" : "Test chartTitle"}';


    // bar
    var txtMetaData_jsonB = '{ "divId" : "chart_div", "divId_table" : "table_div"  , "chartType"  : "bar" , "chartTitle" : "other Test chartTitle"}';

    // Table only
    var txtMetaData_jsonC = '{ "divId" : "chart_div", "divId_table" : "table_div"  , "chartType"  : "table" , "chartTitle" : "other Test chartTitle"}';


    displayData_alt(txtMetaData_jsonA, txtData_jsonB);

}

/**
<script language="JavaScript" type="text/javascript">
<!-- Hide script
//<![CDATA[
exampleTest();
//]]> End script hiding -->
</script>
*/
