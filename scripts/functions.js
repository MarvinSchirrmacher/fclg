/*!
 * jQuery Next-In-Dom
 * http://techfoobar.com/jquery-next-in-dom/
 * 
 * Copyright (c) 2013 Vijayakrishnan Krishnan
 * Released under the MIT License
 * http://techfoobar.com/jquery-next-in-dom/LICENSE.MIT
 */
 (function($) {
 
	$.fn.nextInDOM = function(selector) {
		var element = this;
		if(this.length > 1) { element = this.first(); }
		return nextInDOM(selector?selector:'*', element, $('*').length, $('*').last());
	};
	
	$.fn.prevInDOM = function(selector) {
		var element = this;
		if(this.length > 1) { element = this.first(); }
		return prevInDOM(selector?selector:'*', element, $('*').length, $('*').first());
	};
	
	function nextInDOM(_selector, _subject, _maxNodes, _lastNode) {
		var nid = $(), next = getNext(_subject, _lastNode), iters = 1;
		$('html, body').addClass('cSeen');
	    while(next.length !== 0) {
			if(iters > _maxNodes) { return $(); }
			if(next.is(_selector)) {
				nid = next;
				break;
			}
	        next = getNext(next, _lastNode);
			iters++;
	    }
	    $('.cSeen').removeClass('cSeen');
	    return nid;
	}
	
	function getNext(_subject, _lastNode) {
		if(_subject[0] === _lastNode[0]) { return $(); }
		if(!(_subject.hasClass('cSeen')) && _subject.children().length > 0 && _subject[0].tagName !== 'svg') {
			return _subject.children().first();
		}
		else if(_subject.next().length > 0) {
			return _subject.next();
		}
		else if (_subject.parent().length > 0) {
			_subject.parent().addClass('cSeen');
			return getNext(_subject.parent(), _lastNode);
		}
	    return $();
	}
	
	function prevInDOM(_selector, _subject, _maxNodes, _firstNode) {
	    var prev = getPrev(_subject, _firstNode), iters = 1;
		while(prev.length !== 0) {
			if(iters > _maxNodes) { return $(); }
	    	if(prev.is(_selector)) { return prev; }
	    	prev = getPrev(prev, _firstNode);
			iters++;
	    }
	    return $();
	}
	
	function getPrev(_subject, _firstNode) {
		if(_subject[0] === _firstNode[0]) { return $(); }
	    if(_subject.prev().length > 0 && _subject.prev().children().length > 0) {
			var p = _subject.prev().children().last();
			while(p.children().length > 0) { p = p.children().last(); }
			return p;
		}
		else if(_subject.prev().length > 0) {
			return _subject.prev();
		}
		else if(_subject.parent().length > 0) {
			return _subject.parent();
		}
		return $();
	}
	
})(jQuery);

jQuery.extend( jQuery.easing,
{
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) { return c/2*t*t*t*t + b; }
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	}
});

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) { func.apply(context, args); }
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) { func.apply(context, args); }
	};
}

function getImageDimensions(url){   
    var img = new Image();
    var width;
    var height;

    img.addEventListener('load', function() {
        width = this.naturalWidth;
        height = this.naturalHeight;
    });
    img.src = url;

    return [width, height];
}

function parseThumbnailElements(gallery) {
    var galleryItems = gallery.childNodes;
    var items = [];

    for (var i = 0; i < galleryItems.length; i++) {
    	var galleryItem = galleryItems[i];
        if (galleryItem.nodeType !== 1) {
            continue;
        }

        var icon = galleryItems[i].children[0];
        var link = icon.children[0];
        var image = link.children[0];
        var resolution = icon.getAttribute('data-resolution').split('x');

        var item = {
            src: link.getAttribute('href'),
            w: resolution[0],
            h: resolution[1],
            msrc: image.getAttribute('src')
        };

        item.el = galleryItems[i];
        items.push(item);
    }

    return items;
}

// parse picture index and gallery index from URL (#&pid=1&gid=2)
function photoswipeParseHash() {
    var hash = window.location.hash.substring(1),
    params = {};

    if (hash.length < 5) {
        return params;
    }

    for (var variable in hash.split('&')) {
        if (!variable) {
            continue;
        }
        var pair = variable.split('=');  
        if (pair.length < 2) {
            continue;
        }           
        params[pair[0]] = pair[1];
    }

    if (params.gid) {
        params.gid = parseInt(params.gid, 10);
    }

    return params;
}

function openPhotoSwipe(index, gallery, disableAnimation, fromURL) {
    var pswpElement = document.querySelectorAll('.pswp')[0];
    var items = parseThumbnailElements(gallery);

    var options = {
        galleryUID: gallery.getAttribute('data-pswp-uid'),

        getThumbBoundsFn: function(index) {
            // See Options -> getThumbBoundsFn section of documentation for more info
            var thumbnail = items[index].el.getElementsByTagName('img')[0];
            var pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
            var rect = thumbnail.getBoundingClientRect(); 

            return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
        }
    };

    if (fromURL) {
        if (options.galleryPIDs) {
            for (var j = 0; j < items.length; j++) {
                if (items[j].pid === index) {
                    options.index = j;
                    break;
                }
            }
        } else {
            options.index = parseInt(index, 10) - 1;
        }
    } else {
        options.index = parseInt(index, 10);
    }

    if (isNaN(options.index)) {
        return;
    }

    if (disableAnimation) {
        options.showAnimationDuration = 0;
    }

    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
}

function closest(el, fn) {
    return el && ( fn(el) ? el : closest(el.parentNode, fn) );
}

function initPhotoSwipeFromDOM(gallerySelector) {
    var galleries = document.querySelectorAll(gallerySelector);
	
	var onThumbnailsClick = function(event) {
	    event = event || window.event;
	    event.preventDefault ? event.preventDefault() : event.returnValue = false;

	    var target = event.target || event.srcElement;

	    var clickedGalleryItem = closest(target, function(el) {
	        return (el.tagName && el.tagName.toUpperCase() === 'DL');
	    });

	    if (!clickedGalleryItem) {
	        return;
	    }

	    var clickedGallery = clickedGalleryItem.parentNode;
	    var galleryItems = clickedGallery.childNodes;
	    var nodeIndex = 0;
	    var index = 0;

	    for (index = 0; index < galleryItems.length; index++) {
	        if (galleryItems[index].nodeType !== 1) { 
	            continue;
	        }

	        if (galleryItems[index] === clickedGalleryItem) {
	            index = nodeIndex;
	            break;
	        }
	        nodeIndex++;
	    }

	    if (index >= 0) {
	        openPhotoSwipe(index, clickedGallery);
	    }
	    return false;
	};

    for (var i = 0; i < galleries.length; i++) {
        galleries[i].setAttribute('data-pswp-uid', i + 1);
        galleries[i].onclick = onThumbnailsClick;
    }

    var hashData = photoswipeParseHash();
    if (hashData.pid && hashData.gid) {
        openPhotoSwipe(hashData.pid, galleries[hashData.gid - 1], true, true);
    }
}

( function( $ ) {
	var _window = $( window );

	$( function() {

		if ($(".gallery")[0]) {
			initPhotoSwipeFromDOM('.gallery');
		}

		/* Hide or display any wrapper when the corresponding toggle button was clicked. */

		$('.toggle').on( 'click.fconline tap.fconline', function( event ) {
			var that  = $( this );
			var wrapper = that.nextInDOM( '#' + (event.target.id).replace( 'toggle', 'wrapper' ) );

			that.toggleClass('active');
			wrapper.toggleClass('hidden');

			if (that.is( '#navigation-toggle' )) {
				$('#back-to-top').toggleClass('active');
			}

			if ( that.is('#search-toggle') && that.is('.active') ) {
				wrapper.find('.search-field').focus();
			}
		} );

		/* Hide navigation wrapper when clicking anything except the wrapper itself (on small screens). */

		// debounce( _window.scroll( function( event ) {
		// 	var toggle = $( '#navigation-toggle' );
		// 	var wrapper = $( '#navigation-wrapper' );

		// 	if ( ! wrapper.hasClass( 'hidden' ) ) {
		// 		wrapper.toggleClass( 'hidden' );
		// 		toggle.toggleClass( 'active' );
		// 	}
		// } ), 250 );

		/* Disable scrolling when the navigation wrapper is visible (not hidden) (on small screens). */

		// $( 'html' ).on( 'mousewheel.fconline', function( event ) {
		// 	var wrapper = $( '#navigation-wrapper' );
		// 	var target = $( event.target );

		// 	if ( ! wrapper.hasClass( 'hidden' )
		// 	  && ! target.is( '#navigation-wrapper' )
		// 	  && ! ( target.parents( '#navigation-wrapper' ).length == 1 )
		// 	)
		// 	{
		// 		event.preventDefault();
		// 		event.stopPropagation();
		// 	}
		// } );

		debounce( _window.scroll( function() {
			/* Hide or display back-to-top link. */
			var toggle = $('#navigation-toggle');
			var wrapper = $('#navigation-wrapper');

			if (!wrapper.hasClass('hidden')) {
				wrapper.toggleClass('hidden');
				toggle.toggleClass('active');
			}
			
			var that = $(this);
			var link = $('#back-to-top');
			var offset = 2 * _window.height();

			if (that.scrollTop() > offset) {
				link.removeClass('hidden');
			} else {
				link.addClass('hidden');
			}
		}), 250);

		$('#back-to-top').smoothScroll( {
			easing: 'easeInOutQuart',
			speed: 1000
		});

	});
	
} )( jQuery );