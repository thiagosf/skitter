/*
	click handler for SexyBookmarks
	Credit: Phong Thai Cao - http://www.JavaScriptBank.com
	Please keep this creadit when you use this code
*/
jQuery(document).ready(function() {

	// xhtml 1.0 strict way of using target _blank
	jQuery('.sexy-bookmarks a.external').attr("target", "_blank");

	// this block sets the auto vertical expand when there are more than 
	// one row of bookmarks.
	var sexyBaseHeight=jQuery('.sexy-bookmarks').height();
	var sexyFullHeight=jQuery('.sexy-bookmarks ul.socials').height();
	if (sexyFullHeight>sexyBaseHeight) {
		jQuery('.sexy-bookmarks-expand').hover(
			function() {
				jQuery(this).animate({
						height: sexyFullHeight+'px'
				}, {duration: 400, queue: false});
			},
			function() {
				jQuery(this).animate({
						height: sexyBaseHeight+'px'
				}, {duration: 400, queue: false});
			}
		);
	}
	// autocentering
	if (jQuery('.sexy-bookmarks-center') || jQuery('.sexy-bookmarks-spaced')) {
		var sexyFullWidth=jQuery('.sexy-bookmarks').width();
		var sexyBookmarkWidth=jQuery('.sexy-bookmarks:first ul.socials li').width();
		var sexyBookmarkCount=jQuery('.sexy-bookmarks:first ul.socials li').length;
		var numPerRow=Math.floor(sexyFullWidth/sexyBookmarkWidth);
		var sexyRowWidth=Math.min(numPerRow, sexyBookmarkCount)*sexyBookmarkWidth;
		
		if (jQuery('.sexy-bookmarks-spaced').length>0) {
			var sexyLeftMargin=Math.floor((sexyFullWidth-sexyRowWidth)/(Math.min(numPerRow, sexyBookmarkCount)+1));
			jQuery('.sexy-bookmarks ul.socials li').css('margin-left', sexyLeftMargin+'px');
		} else if (jQuery('.sexy-bookmarks-center'.length>0)) {
			var sexyLeftMargin=(sexyFullWidth-sexyRowWidth)/2;
			jQuery('.sexy-bookmarks-center').css('margin-left', sexyLeftMargin+'px');
		}
		
	}
	
	/*
		click handler for SexyBookmarks
		Credit: Cao Phong - http://www.JavaScriptBank.com
		Please keep this creadit when you use this code
	*/
	jQuery('.sexy-bookmarks a.external').click(function() {
		var url = encodeURIComponent(window.location.href), desc = '';
		if( jQuery('p.sexy-bookmarks-content').length ) {
			desc = encodeURIComponent(jQuery('p.sexy-bookmarks-content').text());
		}
		switch(this.parentNode.className) {
			case 'sexy-twittley':
				this.href += '?title=' + document.title + '&url=' + url + '&desc=' + desc + '&pcat=Internet&tags=';
				break;
			case 'sexy-digg':
				this.href += '?phase=2&title=' + document.title + '&url=' + url + '&desc=' + desc;
				break;
			case 'sexy-twitter':
				this.href += '?status=RT+@thiago9:+' + document.title + '+-+' + url;
				break;
			case 'sexy-scriptstyle':
				this.href += '?title=' + document.title + '&url=' + url;
				break;
			case 'sexy-reddit':
				this.href += '?title=' + document.title + '&url=' + url;
				break;
			case 'sexy-delicious':
				this.href += '?title=' + document.title + '&url=' + url;
				break;
			case 'sexy-stumbleupon':
				this.href += '?title=' + document.title + '&url=' + url;
				break;
			case 'sexy-mixx':
				this.href += '?title=' + document.title + '&page_url=' + url + '&desc=' + desc;
				break;
			case 'sexy-technorati':
				this.href += '?add=' + url;
				break;
			case 'sexy-blinklist':
				this.href += '?Action=Blink/addblink.php&Title=' + document.title + '&Url=' + url;
				break;
			case 'sexy-diigo':
				this.href += '?title=' + document.title + '&url=' + url + '&desc=' + desc;
				break;
			case 'sexy-yahoobuzz':
				this.href += '?submitHeadline=' + document.title + '&submitUrl=' + url + '&submitSummary=' + desc + '&submitCategory=science&submitAssetType=text';
				break;
			case 'sexy-myspace':
				this.href += '?t=' + document.title + '&u=' + url;
				break;
			case 'sexy-facebook':
				this.href += '?t=' + document.title + '&u=' + url;
				break;
			case 'sexy-designfloat':
				this.href += '?title=' + document.title + '&url=' + url;
				break;
			case 'sexy-devmarks':
				this.href += '?posttitle=' + document.title + '&posturl=' + url + '&posttext=' + desc;
				break;
			case 'sexy-newsvine':
				this.href += '?h=' + document.title + '&u=' + url;
				break;
			case 'sexy-google':
				this.href += '?op=add&title=' + document.title + '&bkmk=' + url;
				break;
		}
	})
});
