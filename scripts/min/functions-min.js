function parseThumbnailElements(e){for(var t=e.childNodes,n=[],r=0;r<t.length;r++){if(1===t[r].nodeType){var i=t[r].children[0],a=i.children[0],o=a.children[0],l=i.getAttribute("data-resolution").split("x"),s={src:a.getAttribute("href"),w:l[0],h:l[1],msrc:o.getAttribute("src")};s.el=t[r],n.push(s)}}return n}function photoswipeParseHash(){var e=window.location.hash.substring(1),t={};if(e.length<5)return t;for(var n in e.split("&"))if(n){var r=n.split("=");r.length<2||(t[r[0]]=r[1])}return t.gid&&(t.gid=parseInt(t.gid,10)),t}function openPhotoSwipe(e,t,n,r){var i=document.querySelectorAll(".pswp")[0],a=parseThumbnailElements(t),o={galleryUID:t.getAttribute("data-pswp-uid"),getThumbBoundsFn:function(e){var t=a[e].el.getElementsByTagName("img")[0],n=window.pageYOffset||document.documentElement.scrollTop,r=t.getBoundingClientRect();return{x:r.left,y:r.top+n,w:r.width}}};if(r)if(o.galleryPIDs){for(var l=0;l<a.length;l++)if(a[l].pid===e){o.index=l;break}}else o.index=parseInt(e,10)-1;else o.index=parseInt(e,10);isNaN(o.index)||(n&&(o.showAnimationDuration=0),t=new PhotoSwipe(i,PhotoSwipeUI_Default,a,o),t.init())}function closest(e,t){return e&&(t(e)?e:closest(e.parentNode,t))}function initPhotoSwipeFromDOM(e){for(var t=document.querySelectorAll(e),n=function(e){e=e||window.event,e.preventDefault?e.preventDefault():e.returnValue=!1;var t=e.target||e.srcElement,n=closest(t,function(e){return e.tagName&&"DL"===e.tagName.toUpperCase()});if(n){var r=n.parentNode,i=r.childNodes,a=0,o=0;for(o=0;o<i.length;o++)if(1===i[o].nodeType){if(i[o]===n){o=a;break}a++}return o>=0&&openPhotoSwipe(o,r),!1}},r=0;r<t.length;r++)t[r].setAttribute("data-pswp-uid",r+1),t[r].onclick=n;var i=photoswipeParseHash();i.pid&&i.gid&&openPhotoSwipe(i.pid,t[i.gid-1],!0,!0)}!function($){function e(e,n,r,i){var a=$(),o=t(n,i),l=1;for($("html, body").addClass("cSeen");0!==o.length;){if(l>r)return $();if(o.is(e)){a=o;break}o=t(o,i),l++}return $(".cSeen").removeClass("cSeen"),a}function t(e,n){return e[0]===n[0]?$():!e.hasClass("cSeen")&&e.children().length>0&&"svg"!==e[0].tagName?e.children().first():e.next().length>0?e.next():e.parent().length>0?(e.parent().addClass("cSeen"),t(e.parent(),n)):$()}function n(e,t,n,i){for(var a=r(t,i),o=1;0!==a.length;){if(o>n)return $();if(a.is(e))return a;a=r(a,i),o++}return $()}function r(e,t){if(e[0]===t[0])return $();if(e.prev().length>0&&e.prev().children().length>0){for(var n=e.prev().children().last();n.children().length>0;)n=n.children().last();return n}return e.prev().length>0?e.prev():e.parent().length>0?e.parent():$()}$.fn.nextInDOM=function(t){var n=this;return this.length>1&&(n=this.first()),e(t||"*",n,$("*").length,$("*").last())},$.fn.prevInDOM=function(e){var t=this;return this.length>1&&(t=this.first()),n(e||"*",t,$("*").length,$("*").first())}}(jQuery),jQuery.extend(jQuery.easing,{easeInOutQuart:function(e,t,n,r,i){return(t/=i/2)<1?r/2*t*t*t*t+n:-r/2*((t-=2)*t*t*t-2)+n}}),function($){function e(e){var t=$(this),n="#"+e.target.id.replace("toggle","wrapper"),r=t.nextInDOM(n);t.toggleClass("active"),r.toggleClass("hidden"),t.is(u)&&h.toggleClass("active"),t.is(d)&&t.is(".active")&&r.find(".search-field").focus()}function t(e,t){return e instanceof HTMLElement&&e.id===t.attr("id")}function n(e){return t(e,u)}function r(e){return t(e,c)}function i(e){var t=$("#"+e.id);return r(e)||Object.values(t.parents()).some(r)}function a(e){n(e.target)||i(e.target)||(c.addClass("hidden"),u.removeClass("active"),h.removeClass("active"))}function o(){var e=2*s.height();s.scrollTop()>e?h.removeClass("hidden"):h.addClass("hidden")}function l(e){null===e.target||c.hasClass("hidden")||i(e.target)||e.preventDefault()}var s=$(window),u=$("#navigation-toggle"),c=$("#navigation-wrapper"),d=$("#search-toggle"),h=$("#back-to-top");$(function(){$(".gallery")[0]&&initPhotoSwipeFromDOM(".gallery");var t="click.fconline";$(".toggle").on(t,e),s.on(t,a),s.scroll(_.debounce(function(){o()},250)),h.smoothScroll({easing:"easeInOutQuart",speed:1e3})})}(jQuery);