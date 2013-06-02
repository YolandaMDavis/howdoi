function wikiSearch(searchTerm,headerId,contentId){

    var url = "http://en.wikipedia.org/w/api.php";
    var requestdata = "format=json&action=query&list=search&srwhat=text&format=json&srsearch="+searchTerm;
    
    $.ajax({
            type: "GET",
            url: url,
            dataType: "jsonp",
            data: requestdata,
            success: function (data) {  
                searchBlurbObj = data.query.search[0];
                
                if(searchBlurbObj != undefined){                    
                    $("#"+headerId).text(searchBlurbObj.title);
                    
                    $("#"+contentId).html('<a href="#" title="Read More At Wikipedia">'+searchBlurbObj.snippet+"</a>");
                }                                        
                    
            },
            error: function (data) {
                alert('could not call wiki');
            }
    });
    
}
