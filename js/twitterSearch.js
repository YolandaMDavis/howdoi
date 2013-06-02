function pottyMouthFilter(message){

    var badwords = ["fuck", "shit", "damn", "bitch","nigger","Nigga","ass"];
    for (var i = 0; i < badwords.length; i++) {
        var pat = badwords[i].slice(0, -1).replace(/([a-z])/g, "$1[^a-z]*") + badwords[i].slice(-1);
        var rxp = new RegExp(pat, "ig");
        message = message.replace(rxp, "****");        
    }
    return message
}

function twitterSearch(county,headerId,contentId){

    var url = "http://search.twitter.com/search.json";
    var requestdata = "q="+county+"&rpp=100";
    var tweetArray = new Array();
    
    $.ajax({
            type: "GET",
            url: url,
            dataType: "jsonp",
            data: requestdata,
            success: function (data) {                      
                $.each(data.results,function(i,value){
                var link = 'https://twitter.com/#!/'+value.from_user+'/status/'+value.id_str;
	            tweetArray.push({user:value.from_user,content:'<a href="'+link+'" target="_blank">'+pottyMouthFilter(value.text)+'</a>'});	        
	            });	
            },
            error: function (data) {
                $('#'+contentId).html("Twitter data not available for "+county);
            }
    });
    
    var keyIndex = 0;
    setInterval(function(){
        
                $("#"+contentId).fadeOut(1000,function(){
                    $("#"+headerId).text('@'+tweetArray[keyIndex].user);
                    $("#"+contentId).html(tweetArray[keyIndex].content);
                    $("#"+contentId).fadeIn(1000);
                });
                                
                if(keyIndex == tweetArray.length - 1){
                    keyIndex = 0;           
                }
                else{keyIndex++;}
        
    },5000);
    
}