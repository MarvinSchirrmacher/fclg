/*
 * fussball.de widgetAPI
 */

var egmWidgetUrl = '//www.fussball.de/widget2';

var referer = '';
if(location.host){
	referer = encodeURIComponent(location.host);
}else{
	referer = 'unknown';
}

fussballdeWidgetAPI = function() {
	var D = new Object();
	var C = new Object();

	D.showWidget = function(E, K) {
		if (K != undefined && K != null && K != "" && E != undefined && E != null && E != "") {
			if (document.getElementById(E)) {
				if (K != "") {
					var src = egmWidgetUrl + "/-"
					    + "/schluessel/" + K
						+ "/target/" + E
						+ "/caller/" + referer;
					createIFrame(E, src);
				}
			} else {
				alert("Der angegebene DIV mit der ID " + E
						+ " zur Ausgabe existiert nicht.")
			}
		}
	};

	window.addEventListener("message", receiveMessage, false);
	function receiveMessage(event)
	{
	  if (event.data.type === 'setHeight'){
	    document.querySelectorAll('#' + event.data.container + ' iframe')[0].setAttribute('height', event.data.value + 'px');
	  }
	}
	return D
};


function createIFrame(parentId, src){
	var parent = document.getElementById(parentId);
	var iframe = document.createElement('iframe');
	iframe.frameBorder=0;
	iframe.setAttribute("src", src);
	iframe.setAttribute("scrolling", "no");
	iframe.setAttribute("width", "550px");
	iframe.setAttribute("height", "500px");
	iframe.setAttribute("style", "border: 1px solid #CECECE;");
	parent.innerHTML="";
	parent.appendChild(iframe);
}