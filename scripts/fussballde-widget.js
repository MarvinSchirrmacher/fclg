/*
 * fussball.de widgetAPI
 */

var egmWidget2 = {};

egmWidget2.url = '//www.fussball.de/widget2';

egmWidget2.referer = '';
if (location.host) {
	egmWidget2.referer = encodeURIComponent(location.host);
} else {
	egmWidget2.referer = 'unknown';
}

function createIFrame(parentId, src) {
	var parent = document.getElementById(parentId);
	var iframe = document.createElement('iframe');
	iframe.frameBorder = 0;
	iframe.setAttribute("src", src);
	iframe.setAttribute("scrolling", "no");
	iframe.setAttribute("width", "500px");
	iframe.setAttribute("height", "500px");
	iframe.setAttribute("style", "border: 1px solid #CECECE;");
	parent.innerHTML = "";
	parent.appendChild(iframe);
}

fussballdeWidgetAPI = function () {
	var D = {};

	D.showWidget = function (E, K) {
		if (K !== undefined && K !== null && K !== "" && E !== undefined && E !== null && E !== "") {
			if (document.getElementById(E)) {
				if (K !== "") {
					var src = egmWidget2.url + "/-" + "/schluessel/" + K + "/target/" + E + "/caller/" + egmWidget2.referer;
					createIFrame(E, src);
				}
			} else {
			}
		}
	};

	window.addEventListener("message", function (event) {
		if (event.data.type === 'setHeight') {
			document.querySelectorAll('#' + event.data.container + ' iframe')[0].setAttribute('height', event.data.value + 'px');
		}
		if (event.data.type === 'setWidth') {
			document.querySelectorAll('#' + event.data.container + ' iframe')[0].setAttribute('width', event.data.value + 'px');
		}
	}, false);

	return D;
};