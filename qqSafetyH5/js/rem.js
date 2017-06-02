// JavaScript Document
var s = function() {
var count = 0;

function setHtmlFontSize(callback) {
		var baseWidth = 320,
			baseHeiht = 504,
			baseFontSize = 100,
			newSize = 1,
			sacle = 1;
		if (document.body.clientWidth !== window.innerWidth && count < 10) {
			document.body.style.display = "none";
			window.setTimeout(setHtmlFontSize, 0);
			count++;
		} else {
			var sacle = Math.min(window.innerHeight / baseHeiht),
				newSize = parseInt(sacle * 10000 * baseFontSize) / 10000;
			
			setTimeout(function() {
				document.body.style.display = "";
				if (callback) {
					callback();
				}
				document.documentElement.style.fontSize = newSize + "px";
			}, 0);
		}
	}
	setHtmlFontSize();
}

s()

window.onresize = s;

