function businessSearch(searchTerm,county,state){

var auth = {   
  consumerKey: "oXgc2PNiPLUSQy-fgtd0dw",
  consumerSecret: "GnxxC_L2dwa_kOlo-SsrQRunD7A",
  accessToken: "IruGQm7VD9cSf4RCxfKmVpybJBpxE-mT", 
  accessTokenSecret: "R7kH_7eUiei7tr5CMEGT28EPxyE",
  serviceProvider: { 
    signatureMethod: "HMAC-SHA1"
  }
};

var accessor = {
  consumerSecret: auth.consumerSecret,
  tokenSecret: auth.accessTokenSecret
};

parameters = [];
parameters.push(['callback', 'cb']);
parameters.push(['oauth_consumer_key', auth.consumerKey]);
parameters.push(['oauth_consumer_secret', auth.consumerSecret]);
parameters.push(['oauth_token', auth.accessToken]);
parameters.push(['oauth_signature_method', 'HMAC-SHA1']);
parameters.push(['term',searchTerm]);
parameters.push(['location',county +', '+state]);

var message = { 
  'action': 'http://api.yelp.com/v2/search',
  'method': 'GET',
  'parameters': parameters 
};

OAuth.setTimestampAndNonce(message);
OAuth.SignatureMethod.sign(message, accessor);

var parameterMap = OAuth.getParameterMap(message.parameters);
parameterMap.oauth_signature = OAuth.percentEncode(parameterMap.oauth_signature)
console.log(parameterMap);

$.ajax({
  'url': message.action,
  'data': parameterMap,
  'cache': true,
  'dataType': 'jsonp',
  'jsonpCallback': 'cb',
  'success': function(data, textStats, XMLHttpRequest) {
    console.log(data);
    var output = prettyPrint(data);
    $("body").append(output);
  }
});
    
}