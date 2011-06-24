function openWindow(url,width,height) {
	// derived from PPK, http://www.quirksmode.org/js/croswin.html
	if (!newwindow.closed && newwindow.location) {
		//alert('newwindow is closed or already has a location');
		newwindow.location.href = url;
	}
	else {
		params = (arguments[3])?','+arguemnts[3]:',resizable=yes,scrollbars=no,status=no,toolbar=no';
		var windowOptionsString = [
			'height=',
			height,
			',width=',
			width,
			params
		];
		var windowOptionsString = windowOptionsString.join('');
		newwindow=window.open(url,'window',windowOptionsString);
		if (!newwindow.opener) newwindow.opener = self;
	}
	if (window.focus) {newwindow.focus();}
	if (this != window) {
		return false;
	}
}
function openWindowTMP(url,width,height) {
	// derived from PPK, http://www.quirksmode.org/js/croswin.html
	if (!newwindow.closed && newwindow.location) {
		//alert('newwindow is closed or already has a location');
		newwindow.location.href = url;
	}
	else {
		params = (arguments[3])?','+arguemnts[3]:',resizable=yes,scrollbars=no,status=no,toolbar=no';
		var windowOptionsString = [
			'height=',
			height,
			',width=',
			width,
			params
		];
		var windowOptionsString = windowOptionsString.join('');
		newwindow=window.open(url,'window',windowOptionsString);
		if (!newwindow.opener) newwindow.opener = self;
	}
	if (window.focus) {newwindow.focus();}
	if (this != window) {
		return false;
	}
}

Event.observe(window, 'load', init, false);

function init() {
	if ($('tab_interface')) {
		mostPopular = new tabInterface('tab_interface');
		Element.addClassName($('most_viewed'), 'active');
		stripe('most_popular_items');
	}
	if (!$('slide-list')) return false;
	l = new shifter($('slide-list'));
	if (l.check) {
		m = new PeriodicalExecuter(function() { l.advance() },10);
		leftButton = $('leftbutton')
		pauseButton = $('pausebutton') 
		rightButton = $('rightbutton')
		leftButton.onclick= function(){l.leftClick(); return false}
		pauseButton.onclick= function(){l.toggle(); return false}
		rightButton.onclick= function(){l.rightClick(); return false}
	}
}
function jumpToMenu() {
	var menu = document.getElementById('jumpMenu');
	if (menu.selectedIndex > 1) {
		top.location.href = menu.options[menu.selectedIndex].value;
	}
}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
