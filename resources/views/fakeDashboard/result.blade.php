<?php if (isset($_POST['urlToSearchWith'])){
    // Domain name to submit
    $domain = $_POST['urlToSearchWith'];

    // Register for an API key here https://app.sitetrafficapi.com/register/
    // $monthly = 44444;
   $apikey = "101c173868530db19c98f3d0b066f10f87deaa47";

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, "https://endpoint.sitetrafficapi.com/pay-as-you-go/?key=".trim($apikey)."&host=".$domain);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
   curl_setopt($ch, CURLOPT_TIMEOUT, 30);
   $result = curl_exec($ch);
   curl_close($ch);

   $json = json_decode($result, true);

   echo "Domain: <strong>".htmlspecialchars($domain)."</strong><br />";

   if(!isset($json['error']))
   {
       $monthly = htmlspecialchars($json['data']['estimations']['pageviews']['monthly']);
   }
   else
   {
       echo "API Error: ".htmlspecialchars($json['error'])."<br />";
   }
    ?>
<!DOCTYPE html>
<html lang="en"  >

<head>
    <meta charset="utf-8" />


    <title>Yazey App | Dashboard</title>


    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link rel="shortcut icon" href="https://app.yazey.com/media/logos/icon.png" />


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">


    <link href="https://app.yazey.com/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="https://app.yazey.com/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="https://app.yazey.com/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://app.yazey.com/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="https://app.yazey.com/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="https://app.yazey.com/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <link href="https://app.yazey.com/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="/css/custom-aside.css">
    <script>
        window.intercomSettings = {
          api_base: "https://api-iam.intercom.io",
          app_id: "jbj0c34v"
        };
      </script>
      
      <script>
      // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/jbj0c34v'
      (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/jbj0c34v';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
      </script>


    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        #fb-root{
            display: none !important;
        }

        #loader {
            display: none;
            position: absolute;
            left: 50%;
            z-index: 99999999;
            top: 50%;
            width: 120px;
            height: 120px;
            margin: -76px 0 0 -76px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes  spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }

            to {
                bottom: 0px;
                opacity: 1
            }
        }

        @keyframes  animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }

            to {
                bottom: 0;
                opacity: 1
            }
        }

        #myDiv {
            display: none;
            text-align: center;
        }

        body {
            display: none;
        }

        .firsttable::-webkit-scrollbar {
            width: 12px;
        }

        .firsttable::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            -webkit-border-radius: 8px;
        }

        .firsttable::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: rgba(100, 100, 100, 0.8);
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }


        /*popup*/

        .modal {
            position: absolute;
            z-index: 10000;
            /* 1 */
            top: 0;
            left: 0;
            visibility: hidden;
            width: 100%;
            height: 100%;
            display: block;
        }

        .modal.is-visible {
            visibility: visible;
        }

        .modal-overlay {
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: hsla(0, 0%, 0%, 0.5);
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s linear 0.3s, opacity 0.3s;
        }

        .modal.is-visible .modal-overlay {
            opacity: 1;
            visibility: visible;
            transition-delay: 0s;
        }

        .modal-wrapper {
            position: absolute;
            z-index: 9999;
            top: 6em;
            left: 0%;
            right: 0%;
            width: 550px;
            margin: auto;
            max-width: 100%;
            background-color: #fff;
            box-shadow: 0 0 1.5em hsla(0, 0%, 0%, 0.35);
        }

        .modal-transition {
            transition: all 0.3s 0.12s;
            transform: translateY(-10%);
            opacity: 0;
        }

        .modal.is-visible .modal-transition {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header,
        .modal-content {
            padding: 1em;
        }

        .modal-header {
            position: relative;
            justify-content: flex-end;
            background-color: #fff;
            box-shadow: 0 1px 2px hsla(0, 0%, 0%, 0.06);
            border-bottom: 1px solid #e8e8e8;

        }

        .modal-close {
            color: #aaa;
            background: none;
            border: 0;
        }

        .modal-close:hover {
            color: #777;
        }

        .modal-heading {
            font-size: 1.125em;
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .modal-content>*:first-child {
            margin-top: 0;
        }

        .modal-content>*:last-child {
            margin-bottom: 0;
        }

        .wrapper.pop-updl {
            padding: 0;
            text-align: center;
        }

        .modal-content {
            box-shadow: none;
        }

        .dashboard__class .section__table {
            padding: 0;
            box-shadow: none;
        }
    </style>
    <meta name="csrf-token" content="BIVcyVxnaO8kMb2lqe7kQUayL9yz60HcB62KqA2L">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://app.yazey.com/css/new.css">
    <link rel="stylesheet" href="https://app.yazey.com/css/component.css">
    <link rel="stylesheet" href="https://app.yazey.com/css/layout-global.css">
    <link rel="stylesheet" href="https://app.yazey.com/css/dashboard.css">     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"><link rel='stylesheet' type='text/css' property='stylesheet' href='//app.yazey.com/_debugbar/assets/stylesheets?v=1647931374&theme=auto'><script src='//app.yazey.com/_debugbar/assets/javascript?v=1647931374'></script><script>jQuery.noConflict(true);</script>
    <script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^${}()|\[\]\/\\])/g, idRx = /\bsf-dump-\d+-ref[012]\w+\b/, keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl', addEventListener = function (e, n, cb) { e.addEventListener(n, cb, false); }; refStyle.innerHTML = '.phpdebugbar pre.sf-dump .sf-dump-compact, .sf-dump-str-collapse .sf-dump-str-collapse, .sf-dump-str-expand .sf-dump-str-expand { display: none; }'; (doc.documentElement.firstElementChild || doc.documentElement.children[0]).appendChild(refStyle); refStyle = doc.createElement('style'); (doc.documentElement.firstElementChild || doc.documentElement.children[0]).appendChild(refStyle); if (!doc.addEventListener) { addEventListener = function (element, eventName, callback) { element.attachEvent('on' + eventName, function (e) { e.preventDefault = function () {e.returnValue = false;}; e.target = e.srcElement; callback(e); }); }; } function toggle(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className, arrow, newClass; if (/\bsf-dump-compact\b/.test(oldClass)) { arrow = '▼'; newClass = 'sf-dump-expanded'; } else if (/\bsf-dump-expanded\b/.test(oldClass)) { arrow = '▶'; newClass = 'sf-dump-compact'; } else { return false; } if (doc.createEvent && s.dispatchEvent) { var event = doc.createEvent('Event'); event.initEvent('sf-dump-expanded' === newClass ? 'sfbeforedumpexpand' : 'sfbeforedumpcollapse', true, false); s.dispatchEvent(event); } a.lastChild.innerHTML = arrow; s.className = s.className.replace(/\bsf-dump-(compact|expanded)\b/, newClass); if (recursive) { try { a = s.querySelectorAll('.'+oldClass); for (s = 0; s < a.length; ++s) { if (-1 == a[s].className.indexOf(newClass)) { a[s].className = newClass; a[s].previousSibling.lastChild.innerHTML = arrow; } } } catch (e) { } } return true; }; function collapse(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className; if (/\bsf-dump-expanded\b/.test(oldClass)) { toggle(a, recursive); return true; } return false; }; function expand(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className; if (/\bsf-dump-compact\b/.test(oldClass)) { toggle(a, recursive); return true; } return false; }; function collapseAll(root) { var a = root.querySelector('a.sf-dump-toggle'); if (a) { collapse(a, true); expand(a); return true; } return false; } function reveal(node) { var previous, parents = []; while ((node = node.parentNode || {}) && (previous = node.previousSibling) && 'A' === previous.tagName) { parents.push(previous); } if (0 !== parents.length) { parents.forEach(function (parent) { expand(parent); }); return true; } return false; } function highlight(root, activeNode, nodes) { resetHighlightedNodes(root); Array.from(nodes||[]).forEach(function (node) { if (!/\bsf-dump-highlight\b/.test(node.className)) { node.className = node.className + ' sf-dump-highlight'; } }); if (!/\bsf-dump-highlight-active\b/.test(activeNode.className)) { activeNode.className = activeNode.className + ' sf-dump-highlight-active'; } } function resetHighlightedNodes(root) { Array.from(root.querySelectorAll('.sf-dump-str, .sf-dump-key, .sf-dump-public, .sf-dump-protected, .sf-dump-private')).forEach(function (strNode) { strNode.className = strNode.className.replace(/\bsf-dump-highlight\b/, ''); strNode.className = strNode.className.replace(/\bsf-dump-highlight-active\b/, ''); }); } return function (root, x) { root = doc.getElementById(root); var indentRx = new RegExp('^('+(root.getAttribute('data-indent-pad') || ' ').replace(rxEsc, '\\$1')+')+', 'm'), options = {"maxDepth":1,"maxStringLength":160,"fileLinkFormat":false}, elt = root.getElementsByTagName('A'), len = elt.length, i = 0, s, h, t = []; while (i < len) t.push(elt[i++]); for (i in x) { options[i] = x[i]; } function a(e, f) { addEventListener(root, e, function (e, n) { if ('A' == e.target.tagName) { f(e.target, e); } else if ('A' == e.target.parentNode.tagName) { f(e.target.parentNode, e); } else { n = /\bsf-dump-ellipsis\b/.test(e.target.className) ? e.target.parentNode : e.target; if ((n = n.nextElementSibling) && 'A' == n.tagName) { if (!/\bsf-dump-toggle\b/.test(n.className)) { n = n.nextElementSibling || n; } f(n, e, true); } } }); }; function isCtrlKey(e) { return e.ctrlKey || e.metaKey; } function xpathString(str) { var parts = str.match(/[^'"]+|['"]/g).map(function (part) { if ("'" == part) { return '"\'"'; } if ('"' == part) { return "'\"'"; } return "'" + part + "'"; }); return "concat(" + parts.join(",") + ", '')"; } function xpathHasClass(className) { return "contains(concat(' ', normalize-space(@class), ' '), ' " + className +" ')"; } addEventListener(root, 'mouseover', function (e) { if ('' != refStyle.innerHTML) { refStyle.innerHTML = ''; } }); a('mouseover', function (a, e, c) { if (c) { e.target.style.cursor = "pointer"; } else if (a = idRx.exec(a.className)) { try { refStyle.innerHTML = '.phpdebugbar pre.sf-dump .'+a[0]+'{background-color: #B729D9; color: #FFF !important; border-radius: 2px}'; } catch (e) { } } }); a('click', function (a, e, c) { if (/\bsf-dump-toggle\b/.test(a.className)) { e.preventDefault(); if (!toggle(a, isCtrlKey(e))) { var r = doc.getElementById(a.getAttribute('href').substr(1)), s = r.previousSibling, f = r.parentNode, t = a.parentNode; t.replaceChild(r, a); f.replaceChild(a, s); t.insertBefore(s, r); f = f.firstChild.nodeValue.match(indentRx); t = t.firstChild.nodeValue.match(indentRx); if (f && t && f[0] !== t[0]) { r.innerHTML = r.innerHTML.replace(new RegExp('^'+f[0].replace(rxEsc, '\\$1'), 'mg'), t[0]); } if (/\bsf-dump-compact\b/.test(r.className)) { toggle(s, isCtrlKey(e)); } } if (c) { } else if (doc.getSelection) { try { doc.getSelection().removeAllRanges(); } catch (e) { doc.getSelection().empty(); } } else { doc.selection.empty(); } } else if (/\bsf-dump-str-toggle\b/.test(a.className)) { e.preventDefault(); e = a.parentNode.parentNode; e.className = e.className.replace(/\bsf-dump-str-(expand|collapse)\b/, a.parentNode.className); } }); elt = root.getElementsByTagName('SAMP'); len = elt.length; i = 0; while (i < len) t.push(elt[i++]); len = t.length; for (i = 0; i < len; ++i) { elt = t[i]; if ('SAMP' == elt.tagName) { a = elt.previousSibling || {}; if ('A' != a.tagName) { a = doc.createElement('A'); a.className = 'sf-dump-ref'; elt.parentNode.insertBefore(a, elt); } else { a.innerHTML += ' '; } a.title = (a.title ? a.title+'\n[' : '[')+keyHint+'+click] Expand all children'; a.innerHTML += elt.className == 'sf-dump-compact' ? '<span>▶</span>' : '<span>▼</span>'; a.className += ' sf-dump-toggle'; x = 1; if ('sf-dump' != elt.parentNode.className) { x += elt.parentNode.getAttribute('data-depth')/1; } } else if (/\bsf-dump-ref\b/.test(elt.className) && (a = elt.getAttribute('href'))) { a = a.substr(1); elt.className += ' '+a; if (/[\[{]$/.test(elt.previousSibling.nodeValue)) { a = a != elt.nextSibling.id && doc.getElementById(a); try { s = a.nextSibling; elt.appendChild(a); s.parentNode.insertBefore(a, s); if (/^[@#]/.test(elt.innerHTML)) { elt.innerHTML += ' <span>▶</span>'; } else { elt.innerHTML = '<span>▶</span>'; elt.className = 'sf-dump-ref'; } elt.className += ' sf-dump-toggle'; } catch (e) { if ('&' == elt.innerHTML.charAt(0)) { elt.innerHTML = '…'; elt.className = 'sf-dump-ref'; } } } } } if (doc.evaluate && Array.from && root.children.length > 1) { root.setAttribute('tabindex', 0); SearchState = function () { this.nodes = []; this.idx = 0; }; SearchState.prototype = { next: function () { if (this.isEmpty()) { return this.current(); } this.idx = this.idx < (this.nodes.length - 1) ? this.idx + 1 : 0; return this.current(); }, previous: function () { if (this.isEmpty()) { return this.current(); } this.idx = this.idx > 0 ? this.idx - 1 : (this.nodes.length - 1); return this.current(); }, isEmpty: function () { return 0 === this.count(); }, current: function () { if (this.isEmpty()) { return null; } return this.nodes[this.idx]; }, reset: function () { this.nodes = []; this.idx = 0; }, count: function () { return this.nodes.length; }, }; function showCurrent(state) { var currentNode = state.current(), currentRect, searchRect; if (currentNode) { reveal(currentNode); highlight(root, currentNode, state.nodes); if ('scrollIntoView' in currentNode) { currentNode.scrollIntoView(true); currentRect = currentNode.getBoundingClientRect(); searchRect = search.getBoundingClientRect(); if (currentRect.top < (searchRect.top + searchRect.height)) { window.scrollBy(0, -(searchRect.top + searchRect.height + 5)); } } } counter.textContent = (state.isEmpty() ? 0 : state.idx + 1) + ' of ' + state.count(); } var search = doc.createElement('div'); search.className = 'sf-dump-search-wrapper sf-dump-search-hidden'; search.innerHTML = ' <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0<\/span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"\/><\/svg> <\/button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"\/><\/svg> <\/button> '; root.insertBefore(search, root.firstChild); var state = new SearchState(); var searchInput = search.querySelector('.sf-dump-search-input'); var counter = search.querySelector('.sf-dump-search-count'); var searchInputTimer = 0; var previousSearchQuery = ''; addEventListener(searchInput, 'keyup', function (e) { var searchQuery = e.target.value; /* Don't perform anything if the pressed key didn't change the query */ if (searchQuery === previousSearchQuery) { return; } previousSearchQuery = searchQuery; clearTimeout(searchInputTimer); searchInputTimer = setTimeout(function () { state.reset(); collapseAll(root); resetHighlightedNodes(root); if ('' === searchQuery) { counter.textContent = '0 of 0'; return; } var classMatches = [ "sf-dump-str", "sf-dump-key", "sf-dump-public", "sf-dump-protected", "sf-dump-private", ].map(xpathHasClass).join(' or '); var xpathResult = doc.evaluate('.//span[' + classMatches + '][contains(translate(child::text(), ' + xpathString(searchQuery.toUpperCase()) + ', ' + xpathString(searchQuery.toLowerCase()) + '), ' + xpathString(searchQuery.toLowerCase()) + ')]', root, null, XPathResult.ORDERED_NODE_ITERATOR_TYPE, null); while (node = xpathResult.iterateNext()) state.nodes.push(node); showCurrent(state); }, 400); }); Array.from(search.querySelectorAll('.sf-dump-search-input-next, .sf-dump-search-input-previous')).forEach(function (btn) { addEventListener(btn, 'click', function (e) { e.preventDefault(); -1 !== e.target.className.indexOf('next') ? state.next() : state.previous(); searchInput.focus(); collapseAll(root); showCurrent(state); }) }); addEventListener(root, 'keydown', function (e) { var isSearchActive = !/\bsf-dump-search-hidden\b/.test(search.className); if ((114 === e.keyCode && !isSearchActive) || (isCtrlKey(e) && 70 === e.keyCode)) { /* F3 or CMD/CTRL + F */ if (70 === e.keyCode && document.activeElement === searchInput) { /* * If CMD/CTRL + F is hit while having focus on search input, * the user probably meant to trigger browser search instead. * Let the browser execute its behavior: */ return; } e.preventDefault(); search.className = search.className.replace(/\bsf-dump-search-hidden\b/, ''); searchInput.focus(); } else if (isSearchActive) { if (27 === e.keyCode) { /* ESC key */ search.className += ' sf-dump-search-hidden'; e.preventDefault(); resetHighlightedNodes(root); searchInput.value = ''; } else if ( (isCtrlKey(e) && 71 === e.keyCode) /* CMD/CTRL + G */ || 13 === e.keyCode /* Enter */ || 114 === e.keyCode /* F3 */ ) { e.preventDefault(); e.shiftKey ? state.previous() : state.next(); collapseAll(root); showCurrent(state); } } }); } if (0 >= options.maxStringLength) { return; } try { elt = root.querySelectorAll('.sf-dump-str'); len = elt.length; i = 0; t = []; while (i < len) t.push(elt[i++]); len = t.length; for (i = 0; i < len; ++i) { elt = t[i]; s = elt.innerText || elt.textContent; x = s.length - options.maxStringLength; if (0 < x) { h = elt.innerHTML; elt[elt.innerText ? 'innerText' : 'textContent'] = s.substring(0, options.maxStringLength); elt.className += ' sf-dump-str-collapse'; elt.innerHTML = '<span class=sf-dump-str-collapse>'+h+'<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span>'+ '<span class=sf-dump-str-expand>'+elt.innerHTML+'<a class="sf-dump-ref sf-dump-str-toggle" title="'+x+' remaining characters"> ▶</a></span>'; } } } catch (e) { } }; })(document); </script><style> .phpdebugbar pre.sf-dump { display: block; white-space: pre; padding: 5px; overflow: initial !important; } .phpdebugbar pre.sf-dump:after { content: ""; visibility: hidden; display: block; height: 0; clear: both; } .phpdebugbar pre.sf-dump span { display: inline; } .phpdebugbar pre.sf-dump a { text-decoration: none; cursor: pointer; border: 0; outline: none; color: inherit; } .phpdebugbar pre.sf-dump img { max-width: 50em; max-height: 50em; margin: .5em 0 0 0; padding: 0; background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAHUlEQVQY02O8zAABilCaiQEN0EeA8QuUcX9g3QEAAjcC5piyhyEAAAAASUVORK5CYII=) #D3D3D3; } .phpdebugbar pre.sf-dump .sf-dump-ellipsis { display: inline-block; overflow: visible; text-overflow: ellipsis; max-width: 5em; white-space: nowrap; overflow: hidden; vertical-align: top; } .phpdebugbar pre.sf-dump .sf-dump-ellipsis+.sf-dump-ellipsis { max-width: none; } .phpdebugbar pre.sf-dump code { display:inline; padding:0; background:none; } .sf-dump-public.sf-dump-highlight, .sf-dump-protected.sf-dump-highlight, .sf-dump-private.sf-dump-highlight, .sf-dump-str.sf-dump-highlight, .sf-dump-key.sf-dump-highlight { background: rgba(111, 172, 204, 0.3); border: 1px solid #7DA0B1; border-radius: 3px; } .sf-dump-public.sf-dump-highlight-active, .sf-dump-protected.sf-dump-highlight-active, .sf-dump-private.sf-dump-highlight-active, .sf-dump-str.sf-dump-highlight-active, .sf-dump-key.sf-dump-highlight-active { background: rgba(253, 175, 0, 0.4); border: 1px solid #ffa500; border-radius: 3px; } .phpdebugbar pre.sf-dump .sf-dump-search-hidden { display: none !important; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper { font-size: 0; white-space: nowrap; margin-bottom: 5px; display: flex; position: -webkit-sticky; position: sticky; top: 5px; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > * { vertical-align: top; box-sizing: border-box; height: 21px; font-weight: normal; border-radius: 0; background: #FFF; color: #757575; border: 1px solid #BBB; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > input.sf-dump-search-input { padding: 3px; height: 21px; font-size: 12px; border-right: none; border-top-left-radius: 3px; border-bottom-left-radius: 3px; color: #000; min-width: 15px; width: 100%; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next, .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-previous { background: #F2F2F2; outline: none; border-left: none; font-size: 0; line-height: 0; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next { border-top-right-radius: 3px; border-bottom-right-radius: 3px; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next > svg, .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-previous > svg { pointer-events: none; width: 12px; height: 12px; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-count { display: inline-block; padding: 0 5px; margin: 0; border-left: none; line-height: 21px; font-size: 12px; }.phpdebugbar pre.sf-dump, .phpdebugbar pre.sf-dump .sf-dump-default{word-wrap: break-word; white-space: pre-wrap; word-break: normal}.phpdebugbar pre.sf-dump .sf-dump-num{font-weight:bold; color:#1299DA}.phpdebugbar pre.sf-dump .sf-dump-const{font-weight:bold}.phpdebugbar pre.sf-dump .sf-dump-str{font-weight:bold; color:#3A9B26}.phpdebugbar pre.sf-dump .sf-dump-note{color:#1299DA}.phpdebugbar pre.sf-dump .sf-dump-ref{color:#7B7B7B}.phpdebugbar pre.sf-dump .sf-dump-public{color:#000000}.phpdebugbar pre.sf-dump .sf-dump-protected{color:#000000}.phpdebugbar pre.sf-dump .sf-dump-private{color:#000000}.phpdebugbar pre.sf-dump .sf-dump-meta{color:#B729D9}.phpdebugbar pre.sf-dump .sf-dump-key{color:#3A9B26}.phpdebugbar pre.sf-dump .sf-dump-index{color:#1299DA}.phpdebugbar pre.sf-dump .sf-dump-ellipsis{color:#A0A000}.phpdebugbar pre.sf-dump .sf-dump-ns{user-select:none;}.phpdebugbar pre.sf-dump .sf-dump-ellipsis-note{color:#1299DA}</style>
</head>

<body  id="kt_body"   class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed aside-enabled aside-fixed page-loading" >
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=630037578026405&autoLogAppEvents=1" nonce="eg6Zq93I"></script>
{{-- <div id="loader"></div> --}}

<div id="kt_header_mobile" class="header-mobile  header-mobile-fixed " >
    <div class="mobile-logo">
        <a href="https://app.yazey.com">





            <img alt="Yazey App" src="/images/logo.png" width="40px"/>
        </a>
    </div>
    <div class="mobile-toolbar">

        <button class="mobile-toggle mobile-toggle-left" id="kt_aside_mobile_toggle">
            <img src="/images/hamburger.svg" width="24px" alt="">
        </button>




    </div>
</div>

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">

        <div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">


            <div class="brand flex-column-auto " id="kt_brand">
                <div class="brand-logo">
                    <a href="https://app.yazey.com">
                        <img src="https://app.yazey.com/images/logo.png" alt="" width="40px">
                        <!-- <img src="https://app.yazey.com/images/logo-text.png" alt="" width="200px"> -->
                    </a>
                </div>



            </div>


            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">


                <div
                        id="kt_aside_menu"
                        class="aside-menu my-4 "
                        data-menu-vertical="1"
                        data-menu-scroll="1" data-menu-dropdown-timeout="500" >

                    <ul class="menu-nav ">
                        <li class="menu-item  menu-item-active" aria-haspopup="true" ><a  href="https://app.yazey.com/dashboard" class="menu-link "><span class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/Shopping/Chart-bar3.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="7" y="4" width="3" height="13" rx="1.5"/>
        <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
    </g>
</svg><!--end::Svg Icon--></span><span class="menu-text">Yazey Dashboard</span></a></li>
<li class="menu-item " aria-haspopup="true"><a onclick="loginV2()" class="menu-link "><span class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/General/AGENCY.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="67.899px" height="66.937px" viewBox="0 0 67.899 66.937" enable-background="new 0 0 67.899 66.937" xml:space="preserve">
    <g display="none">
        <path display="inline" fill="#7E9FB8" d="M30.909,32.253l2.341-0.057V7.974c-0.772-0.063-1.552-0.104-2.341-0.104   c-6.766,0-12.976,2.37-17.854,6.321L30.909,32.253z"></path>
        <path display="inline" fill="#7E9FB8" d="M34.671,32.071l29.687-0.234c1.43-18.741-9.955-30.153-29.824-29.528L34.671,32.071z"></path>
        <path display="inline" fill="#7E9FB8" d="M30.028,34.436L11.688,15.37c-5.637,5.188-9.172,12.627-9.172,20.894   c0,7.401,2.834,14.14,7.475,19.193L30.028,34.436z"></path>
        <path display="inline" fill="#7E9FB8" d="M59.019,33.542H34.754L11.817,57.279l-1.785-1.777c5.188,5.627,12.619,9.154,20.876,9.154   c15.681,0,28.393-12.712,28.393-28.393c0-0.918-0.046-1.824-0.134-2.719C59.167,33.536,59.019,33.542,59.019,33.542z"></path>
    </g>
    <path fill="#7E9FB8" d="M55.402,41.076v-4.304h2.318c11.588-2.648,4.636-9.933,4.636-9.933c-1.655-2.317-9.602-3.972-9.602-3.972  v-1.324C47.788,5.982,44.146,3.665,44.146,3.665h-5.629v1.656l-8.276,0.662V3.665h-8.608c-4.635,8.938-5.628,16.222-5.628,16.222  l-1.655,2.649c-5.628,1.324-8.939,3.642-8.939,3.642c-7.946,9.932,6.291,10.925,6.291,10.925c3.311,2.649-4.635,7.614-4.635,7.614  c-9.932,7.614,4.304,11.918,4.304,11.918c3.642,0.332,2.317,3.311,2.317,3.311c-0.993,1.325-2.317,3.392-2.317,3.392l45.025-0.081  c2.318,0.662-1.654-2.979-1.654-2.979c-2.318-0.994,0.33-2.98,0.33-2.98c1.986,0,5.96-2.979,5.96-2.979  C69.972,47.366,55.402,41.076,55.402,41.076z M17.991,22.537h1.325v1.655h3.972v1.49h21.52V24.11h3.476v-1.573h1.365v2.524  l-1.116-0.373l0.123,1.738h-3.972v1.117h-8.939v1.49h-2.979v-1.242h-9.808v-1.241h-3.641v-0.765h-1.325V22.537z M51.141,41.325  c-2.359,4.221-9.064,14.153-9.064,14.153c-8.442,12.539-15.767,0-15.767,0c-6.208-5.711-10.677-14.402-10.677-14.402v-2.855h2.358  v1.118h2.607c-0.621,2.111,0.125,3.725,0.125,3.725c3.352,5.462,10.801,2.607,10.801,2.607v-0.993l0.745-0.373v-5.09h3.228v5.214  c5.959,5.09,11.67-1.117,11.67-1.117l0.124-3.601h2.358v-1.49h2.607C53.002,39.834,51.141,41.325,51.141,41.325z"></path>
    </svg><!--end::Svg Icon--></span><span class="menu-text">Agency Spy</span></a></li>
<li class="menu-item " aria-haspopup="true" >
    <a  onclick="loginV2()" class="menu-link "><span class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/General/User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span><span class="menu-text">My Profile</span></a></li>
                    </ul>
                </div>

                <div id="bottom-menu-user" class="d-flex justify-content-between align-items-center">
                    <div class="custom__user w-100 d-flex justify-content-between align-items-center">
                        <div class="user d-flex align-items-center justify-content-start" style="flex: 1; cursor: pointer">
                                        <span class="user-avatar">
                        <img id="company_avatar"
                             src=""
                             onerror="this.onerror=null; this.src='/images/logo.png'"
                             height='100%' alt="ahmed payyoumy" />
                        <div class="active__btn"></div>
                    </span>
                            <div style="overflow: hidden; margin-left: 14px" class="user__name font-weight-bolder d-md-inline mr-3 none-minimize" data-toggle="tooltip" title="ahmed payyoumy">
                                <div class="profile__name">
                                    <?=$domain?>
                                </div>
                                <div class="edit__profile">
                                    <a href="/my-profile">
                                        Edit profile
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group dropup">
                            <span class="drop-logout" style="font-size: 14px; cursor: pointer; color: #94A3B8;font-weight: bold;">...</span>
                            <div class="dropdown-menu dropdown-menu-right" style="width: 200px;height: auto;left: -40px;">
                                <a onclick="loginV2()" class="btn btn-primary dddd" style="max-width:fit-content;font-size:14px;background: #2026E9;display: flex;margin-top:8px;padding:13px 35px;align-items: center;color: #FFF;border-radius: 10px;font-family: sans-serif;text-transform: none;">
                                    <i class="fa-brands fa-facebook-square fa-2x"></i>
                                    <span style="margin-left:10px;"><span style="margin-left:10px;">Login With Facebook</span></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

            <div id="kt_header" class="header  class="header-fixed" " >

            <div class="container-fluid d-flex align-items-center justify-content-between">





                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

                    <div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default " >
                        <ul class="menu-nav ">

                        </ul>
                    </div>
                </div>


                <div class="topbar">














                    <div class="topbar-item">
                        <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                            <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                            <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?=$domain?></span>
                            <span class="symbol symbol-35 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">


            <div class="d-flex flex-column-fluid">
                <div class=" container-fluid ">


                    <style>
                        .yo{
                            font-size: 24px;
                            font-weight: bold;
                            color: #06152B;
                            border: 1px solid #06152B;
                            border-radius: 5px;
                            text-align: center;
                            margin: 20px 0px;
                            width: auto;
                            display: inline-block;
                            padding: 2px 20px;
                        }
                    </style>


                    <div class="container dashboard__class">

                        <div class="header__top">
                            <div class="flex__header__top">
                                <div class="col__left">
                                    <div class="flex__text__select">
                                        <div class="text">
                                            Dashboard Overview:
                                        </div>
                                        <div class="select">
                                            <b><?= $_POST['urlToSearchWith']?></b>
                                            <!--Not selected-->
                                            <!-- <select name="account_id" id="">
                                                                                                                    <option value="40">
                                                            Himanshu Shokhanda
                                                        </option>
                                                                                        <option value="41">
                                                            Yazey.com
                                                        </option>
                                                                                        <option value="46">
                                                            454312498649220
                                                        </option>
                                                                                        <option value="47">
                                                            Ash Barbour
                                                        </option>
                                                                                        <option value="103">
                                                            Rahul Dhunna
                                                        </option>
                                                                                        <option value="104">
                                                            2338774579577075
                                                        </option>
                                                                                        <option value="105">
                                                            Rahul Dhunna
                                                        </option>
                                                                                                        </select> -->
                                        </div>
                                    </div>
                                    <div class="text__gray text__bold">
                                        {{date('h:i A')}}, {{date('jS F Y')}}
                                    </div>
                                </div>

                                <div class="col__right">
                                    <!-- <div class="search__box">
                                        <input type="text" name="q">
                                        <div class="icon">
                                            <img src="/images/dashboard/search-icon.png" width="20px" alt="">
                                        </div>
                                    </div>

                                    <div class="select__box">
                                        <select name="" id="">
                                            <option value="">This year</option>
                                            <option value="">This year</option>
                                            <option value="">This year</option>
                                        </select>
                                        <div class="icon__select">
                                            <img src="/images/dashboard/chvr-down.png" width="14px" alt="">
                                        </div>
                                    </div>

                                    <div class="notification__box">
                                        <div class="action__noti blue"></div>
                                        <img src="/images/dashboard/bell.png" width="22px" alt="">
                                    </div>

                                    <div class="change__language__box">
                                        <img src="/images/dashboard/us.png" width="22px" alt="">
                                    </div> -->

                                    {{-- <div class="avatar__box">
                                        <a href="#">
                                            <img src="https://app.yazey.com/images/logo.png" width="130px" alt="ahmed payyoumy" />
                                        </a>
                                    </div> --}}

                                    <div class="btn-group dropup" style="margin-left: 10px;">
                                        <span class="drop-logout" style="font-size: 14px; cursor: pointer; color: #94A3B8;font-weight: bold;">...</span>
                                        <div class="dropdown-menu dropdown-menu-right" style="width: 200px;height: auto;left: -40px;margin-bottom: -9.875rem;">
                                            <a onclick="loginV2()" class="btn btn-primary dddd" style="width:max-content;font-size:17px;background: #2026E9;display: flex;margin-top:8px;padding:13px 35px;align-items: center;color: #FFF;border-radius: 10px;font-family: sans-serif;text-transform: none;">
                                                <i class="fa-brands fa-facebook-square fa-2x"></i>
                                                <span style="margin-left:10px;">Login With Facebook</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="statistic__section box-size">



                            <div class="statistic__box">
                                <div class="statistic__header">
                                    <div class="icon__stt">
                                        <img src="https://app.yazey.com/images/Increase.png">
                                        <!--<i class="fas fa-credit-card text-primary icon-lg"></i>-->
                                        <div class="col__stt__right">
                                            <div class="box__icon__arr_red">
                                                <img src="https://app.yazey.com/images/dashboard/arrow-red.png" width="8px" alt="">
                                            </div>
                                            <div class="text__red">
                                                ----%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stt__total">
                                    <div class="head__total">
                                        Your ROAS
                                    </div>
                                    <div class="money" id="totalSpend">
                                        <!--dynamic roas-->
                                        <!---->
                                        <!--0 x-->
                                        <!---->
                                        <a onclick="loginV2()" class="btn btn-primary" style="width:max-content;font-size:17px;background: #2026E9;display: flex;margin-top:8px;padding:13px 35px;align-items: center;color: #FFF;border-radius: 10px;font-family: sans-serif;text-transform: none;">
                                            <i class="fa-brands fa-facebook-square fa-2x"></i>
                                            <span style="margin-left:10px;font-weight:bold;">Login With Facebook</span>
                                            {{-- <img src="{{asset('images/login_with_facebook.png')}}" height="60" style="max-height: none;" width="300" alt="Facebook login button png" /> --}}
                                        </a>
                                        {{-- <span class="yo" style="font-size: 24px;font-weight: bold;color: #06152B;"><a href="https://app.yazey.com/connect-data" style="color: inherit;">Connect data</a> </span> --}}
                                        <span style="filter: blur(5px);">$209,879</span>



                                    </div>
                                    <div class="text__gray">
                                        Compared to (2.20% last year)
                                    </div>
                                </div>
                            </div>

                            <div class="statistic__box">


                                <div class="statistic__header">
                                    <div class="icon__stt">
                                        <img src="https://app.yazey.com/images/People.png">
                                        <!--<i class="fas fa-credit-card text-primary icon-lg"></i>-->
                                        <div class="col__stt__right">
                                            <div class="box__icon__arr__green">
                                                <img src="https://app.yazey.com/images/dashboard/arrow-green.png" width="8px" alt="">
                                            </div>
                                            <div class="text__green">
                                                ---- %
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stt__total">
                                    <div class="head__total">
                                        Your Traffic
                                    </div>
                                    <div class="money" id="totalSpend">
                                        <span><?=$monthly?></span>
                                    </div>
                                    <div class="text__gray">
                                        Compared to ($193,400 last year)
                                    </div>
                                </div>

                            </div>

                            <div class="statistic__box statistic__box_cs__">
                                <div class="statistic__header">
                                    <div class="icon__stt">
                                        <img src="https://app.yazey.com/images/Money Bag.png">
                                        <!--<i class="fas fa-credit-card text-primary icon-lg"></i>-->
                                        <div class="col__stt__right">
                                            <div class="box__icon__arr__green">
                                                <img src="https://app.yazey.com/images/dashboard/arrow-green.png" width="8px" alt="">
                                            </div>
                                            <div class="text__green">
                                                ----%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="stt__total">
                                    <div class="head__total">
                                        Your Sales
                                    </div>
                                    <div class="money" id="totalSpend">
                                        <!---->
                                        <!--  0-->
                                        <!--  -->



                                        <span style="filter: blur(5px);">$209,879</span>
                                    </div>
                                    <div class="text__gray">
                                        Compared to ($193,400 last year)
                                    </div>
                                </div>
                            </div>




                            <div class="statistic__box statistic__box_cs__">


                                <div class="statistic__header">
                                    <div class="icon__stt">
                                        <div class="head__total">
                                            Your sales goal for <spna>the past year</spna>

                                            <div class="stt__total">

                                                <div class="money" id="totalSpend">

                                                    <span style="filter: blur(5px);">$308,647</span>
                                                    <p style="font-size: 13px;margin: 0px;line-height: 30px;">Coming Soon</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col__stt__right" id="chart2">

                                        </div>
                                    </div>
                                </div>

                            </div>





                        </div>




                        <div class="grid__chart">
                            <style>
                                .dddd
                                {
                                    font-size: 24px;
                                    font-weight: bold;
                                    color: #06152B;
                                    border: 1px solid #06152B;
                                    border-radius: 5px;
                                    text-align: center;
                                    margin: 20px 0px;
                                    width: auto;
                                    display: inline-block;
                                    padding: 10px 20px;
                                }
                            </style>

                            <div class="col__left pt-4">
                                <div class="tab__header custom__pst" style="z-index: 9999;">
                                    <ul>
                                        <li class="active" id="cpc" onclick="cpcsales()">
                                            <a href="javascript:void(0)">CPC Graph</a>
                                        </li>
                                        <li id="mros" onclick="marketingroas()">
                                            <a href="javascript:void(0)">Marketing ROAS</a>
                                        </li>
                                        <li onclick="monthlysales()" id="ms">
                                            <a href="javascript:void(0)">Monthly Sales</a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="chart4" class="text-center chart-bg-new" style="padding: 10px;">
                                    <div class="money" id="totalSpend" style="display: flex;position: absolute;left: 40%;top: 36%;width: 25%;">
                                        <a onclick="loginV2()" class="btn btn-primary dddd" style="max-width:fit-content;font-size:17px;background: #2026E9;display: flex;margin-top:8px;padding:13px 35px;align-items: center;color: #FFF;border-radius: 10px;font-family: sans-serif;text-transform: none;">
                                            <i class="fa-brands fa-facebook-square fa-2x"></i>
                                            <span style="margin-left:10px;">Login With Facebook</span>
                                        </a>
    
                                        {{-- <span class="dddd" style="font-size: 60px;font-weight: bold;/*display: block;*/color: #06152B;"><a href="https://app.yazey.com/connect-data" style="color: inherit;">Connect data</a> </span> --}}
                                    </div>
                                    <img src="https://app.yazey.com/images/comming-soon-new2.png" height="300px" style="visibility: hidden" />
                                </div>

                            </div>

                        </div>



                        <div class="section__table">
                            <div class="tb__header">
                                <div class="hd__left">
                                    ROAS Ranking Table
                                </div>
                                <div class="hd__right">
                                    <div class="btn btn__download">
                                        <img src="/images/dashboard/download.png" width="16px" alt=""> Generate Report
                                    </div>
                                    <div class="icon__dots">
                                        <img src="/images/dashboard/dotted-icon.png" width="28px" alt="">
                                    </div>
                                </div>
                            </div>


                            <style>
                                .table-blur {}

                                .table-blur tbody tr:hover {
                                    background: transparent !important;
                                    color: #000 !important;
                                }

                                .dashboard__class .section__table .tb__header .hd__right {
                                    display: none !important;
                                }
                            </style>
                            <div class="col-md-12">
                                <div id="loader"></div>
                                <div class="firsttable" style="max-height:545px; overflow-y:scroll; overflow-x:hidden;">
                                    <table class="table table1">
                                        <thead>
                                        <tr>
                                            <th class="th__tb">Rank No.</th>
                                            <th class="th__tb">Monthly Traffic</th>
                                            <th class="th__tb">Store Industry</th>
                                            <th class="th__tb">Monthly Sale</th>
                                            <th class="th__tb">Marketing Spend</th>
                                            <th class="th__tb">Marketing ROAS</th>
                                            <th class="th__db">CPC</th>
                                            <th class="th__tb">Marketing</th>
                                        </tr>
                                        </thead>
                                        <tbody id="post_data">
                                        <tr class="ajaxdata highlight" style="background-color: #2026E9;color:white;" data-id="1">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    1
                                                </div>
                                            </td>
                                            <td class="td__tb"><?=$monthly?></td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        <tr class="ajaxdata " data-id="3">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    3
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9123
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="4">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    4
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                5348
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="5">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    5
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                7139
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="6">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    6
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                3526
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="7">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    7
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                9518
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="8">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    8
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                6899
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="9">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    9
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                5878
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="10">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    10
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                5151
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="11">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    11
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                2493
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>

                                        <tr class="ajaxdata " data-id="12">
                                            <td class="td__tb">
                                                <div class="d-flex gap5 align-item-center justify-content-center">
                                                    12
                                                </div>
                                            </td>
                                            <td class="td__tb">
                                                33600
                                            </td>
                                            <td class="td__tb" style="filter: blur(4px);">Book</td>
                                            <td class="td__tb" style="filter: blur(4px);">$ 262</td>
                                            <!--<td class="td__tb"><img src="https://app.yazey.com/images/blur-number.png" width="45%" /></td>-->
                                            <td class="td__tb " style="filter: blur(4px);">$ 36.3</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb " style="filter: blur(4px);">2.000X</td>
                                            <td class="td__tb connect-agency__" style="filter: blur(4px);">
                                                <div class="tag__green">AGENCY</div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    
                                <div class="form-group" style="position:absolute;top: 50%; left: 50%;">
                                    <a onclick="loginV2()" class="btn btn-primary dddd" style="max-width:inherit;font-size:17px;background: #2026E9;display: flex;margin-top:8px;padding:13px 35px;align-items: center;color: #FFF;border-radius: 10px;font-family: sans-serif;text-transform: none;">
                                        <i class="fa-brands fa-facebook-square fa-2x"></i>
                                        <span style="margin-left:10px;">Login With Facebook</span>
                                    </a>                                        
                                        {{-- <a class="btn btn-primary" target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=450'); return false;" href="https://www.facebook.com/v13.0/dialog/oauth?response_type=token&display=popup&client_id=630037578026405&redirect_uri=https%3A%2F%2Fdevelopers.facebook.com%2Ftools%2Fexplorer%2Fcallback%3Fmethod%3DGET%26path%3Dme%252Faccounts%26version%3Dv13.0&auth_type=rerequest&scope=email%2Cpages_manage_metadata%2Cpublic_profile%2Cpages_manage_ads%2Cads_read%2Cads_management%2Cpages_show_list%2Cpages_read_engagement%2Cpages_read_user_content%2Cpages_manage_posts%2Cpages_manage_engagement%2Cpages_manage_instant_articles%2Cpages_manage_cta">
                                        <span style="margin-left:10px;">Login With Facebook</span>                                      
                                        </a> --}}
                                </div>
                            </div>

                        </div>
                        <!-- Messenger Chat plugin Code -->
                        <div id="fb-root"></div>

                        <!-- Your Chat plugin code -->
                        <div id="fb-customer-chat" class="fb-customerchat">
                        </div>

                        <script>
                            var chatbox = document.getElementById('fb-customer-chat');
                            chatbox.setAttribute("page_id", "100894342331082");
                            chatbox.setAttribute("attribution", "biz_inbox");

                            window.fbAsyncInit = function() {
                                FB.init({
                                    xfbml: true,
                                    version: 'v12.0'
                                });
                            };

                            (function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                        </script>

                    </div>

                    <script type="text/javascript">
                        var accounts = JSON.parse('[{"id":40,"name":"Himanshu Shokhanda","logo_src":null,"social_id":"act_248686272520534","access_token":"EAAI9BA4IjaUBADu0zKvMlYxg906a6CoH7XoXiITKppZC8e5muUx6LZCCZA8ljsZBrPviSUe9Ez9ECqea2MstdnTN0nLOjjBGzuD1Xf1bAqhct4Gb0cORj8dyzlHfTcKSrs0tyCKIwtpr5AZBHO9qb8uWmtLyZBHIH0neMtxfypmyufBuZCuRGbZA623MKiZBKpmsZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-01-05T20:01:47.000000Z","updated_at":"2022-01-13T19:52:17.000000Z","user_id":26,"facebook_ads_social_account":{"id":35,"account_id":"act_248686272520534","social_account_id":40,"created_at":"2022-01-05T20:01:47.000000Z","updated_at":"2022-01-05T20:01:47.000000Z","spend":0}},{"id":41,"name":"Yazey.com","logo_src":null,"social_id":"act_1320492491698772","access_token":"EAAI9BA4IjaUBAE8wLOoOyDYxftL0AwI4O04z4pt6IV9BsXhjDOF0umaTpTZC3XFbusZA2GuH5iILMEWfLZAKoSleEjVBZBdNbQ2JOySl1HuqJAkZA3L9JVRypeFNRTLzA6XU9krcOBZByPttm2xUC3HfqK6l6POoocIFgX89YBSzH5MZAGn07YTALv1AI1XkkIZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-01-05T20:01:49.000000Z","updated_at":"2022-04-23T16:49:09.000000Z","user_id":26},{"id":46,"name":"454312498649220","logo_src":null,"social_id":"act_454312498649220","access_token":"EAAI9BA4IjaUBAAsScCI3EBSMmzzpvq6T3shbMDZBDpQP2kxZBiodfFPNrhb5va0jeZCg7EtbUiXhlhcTcCpOmrHN8i3v7KD4h6CMC31ZCM8BtcSZBg2TZBuAWKgDlJh7ZAccowDThyMPkfOVThdAOFTZAGZARyZBYKcIcISuHasNWoE2fS6uWxFdZAfeZAh9pUFLPjIZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-04-15T08:55:56.000000Z","updated_at":"2022-04-23T16:49:05.000000Z","user_id":113},{"id":47,"name":"Ash Barbour","logo_src":null,"social_id":"act_3033124330292027","access_token":"EAAI9BA4IjaUBAHWRtvDw5RZAZAqLHphDkq61KRtxCDrk6FqCOo2WZC0j3ZCKge39z3gclizqZBNSVmgZCjWZBeewGr309vidWZC6X1Y09bCPqZBDPDk6qxL504IGCmaCIwotyoGcI5S1zFtb0NCf5kXsj4nfIgiHikIgEmx7FtN0xPUWvFoQ5MjWPpg49iVjJi3EZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-04-15T08:56:07.000000Z","updated_at":"2022-04-23T16:49:12.000000Z","user_id":113},{"id":103,"name":"Rahul Dhunna","logo_src":null,"social_id":"act_196298405","access_token":"EAAI9BA4IjaUBAIGK9fBzlB3JgS57SEnab1rWqg8tR54JnaD5LC04ZARmNGJIXkhbZCpSHH57cZCqlshXRUZAuZCbiKkiJDsqAiunvyjNZBbzD2QruCeD2HTx9o9pfEZAJ8jyuNo6ZCUXwklXmqTCZBOZBhOTqdZCWZAEMmDZBTPLBKvNLO6rZCI566yHdSd2xuJTjQrIYZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-04-19T11:48:57.000000Z","updated_at":"2022-04-19T11:48:57.000000Z","user_id":138},{"id":104,"name":"2338774579577075","logo_src":null,"social_id":"act_2338774579577075","access_token":"EAAI9BA4IjaUBANzzglZAx1JldhEB6Tbyr5Cb77ZBZBwtBZBMLVvZBnFwU0jWsnMET4Q5ZCM3gaq3wUKZCWrUE67M6FaFUuMTEqbJ8IDvC6EEg8sNiTZB1X4jykpe4d9xMNTxum2WXN7xPjemoHwXyihCSFLQ2N85tQwLRvb00JTp1ZBPRmt6HWIZCVcXWx0U3At9QZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-04-19T11:49:00.000000Z","updated_at":"2022-04-19T11:49:00.000000Z","user_id":138},{"id":105,"name":"Rahul Dhunna","logo_src":null,"social_id":"act_426547204952699","access_token":"EAAI9BA4IjaUBAE2HbLgMSGTTZCh1uqyi6bVouO9iRdQQPThsoAAN0JsjZCEZBDAAiq5j6e5MINg6IjT5PHoM3mizYdMKojUnDah6igK0ZB5Oy0IjgB1IL7G5njlOsCa8gQZAOZCt56I1oipfVIxlAiAVbe4nJfKizaR1MIWrRs8ZBlSwtWQZBRYWD5z9adEF0ZC0ZD","note":"C\u1eadp nh\u1eadt token th\u00e0nh c\u00f4ng","data_source_id":4,"created_at":"2022-04-19T11:49:04.000000Z","updated_at":"2022-04-19T11:49:04.000000Z","user_id":138}]');
                    </script>
                    <script>
                        loginV2 = function() {
                            FB.login(function(response){
                                // handle the response
                                FB.api(
                                    "/"+response.authResponse.userID+"?fields=name,email,id,picture{url}",
                                    function (data) {
                                        if (data && !data.error) {
                                            /* handle the result */
                                            $.ajax({
                                                method: "POST",
                                                url : "{{url('/fbregister')}}",
                                                data: {_token : "{{csrf_token()}}", request1 : response, request2 :data},
                                                success: function(res){
                                                    if(res){
                                                        $('#loader').show();
                                                        FB.api("me/accounts?fields=picture{url},name,access_token,page_token,website",
                                                            function(res){
                                                                $.ajax({
                                                                    method: "POST",
                                                                    url : "{{url('/fbregisterPage')}}",
                                                                    data: {_token : "{{csrf_token()}}", payload : res},
                                                                    success: function(d) {
                                                                        if(d === "good"){
                                                                            window.location.href = "/facebook-ads/get-access-tokenV2/" + response.authResponse.accessToken + "&" + response.authResponse.userID;
                                                                        } else {
                                                                            console.log(d);
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                        );
                                                    }
                                                }
                                            });
                                        }
                                    }
                                );
                            },
                            {
                                scope: 'public_profile,ads_read,ads_management,read_insights,pages_read_engagement,pages_manage_ads',
                                return_scopes: true,
                                enable_profile_selector: true
                            });
                            // var page = "https://www.facebook.com/v13.0/dialog/oauth?response_type=token&display=popup&client_id=630037578026405&redirect_uri=https%3A%2F%2Fdevelopers.facebook.com%2Ftools%2Fexplorer%2Fcallback%3Fmethod%3DGET%26path%3Dme%252Faccounts%26version%3Dv13.0&auth_type=rerequest&scope=email%2Cpages_manage_metadata%2Cpublic_profile%2Cpages_manage_ads%2Cads_read%2Cads_management%2Cpages_show_list%2Cpages_read_engagement%2Cpages_read_user_content%2Cpages_manage_posts%2Cpages_manage_engagement%2Cpages_manage_instant_articles%2Cpages_manage_cta";

                            // var $dialog = $('<div></div>')
                            //             .html('<iframe style="border: 0px; " src="' + page + '" width="100%" height="100%"></iframe>')
                            //             .dialog({
                            //                 autoOpen: false,
                            //                 modal: true,
                            //                 height: 625,
                            //                 width: 500,
                            //                 title: "Some title"
                            //             });
                            // $dialog.dialog('open');
                        };
                        logInWithFacebookAds = function() {
                            // FB.api('/me/permissions/pages_show_list', 'DELETE', function(){
                            FB.login(function(response) {
                                if (response.authResponse) {
                                    window.location.href = "/facebook-ads/get-access-token/" + response.authResponse.accessToken + "&" + response.authResponse.userID;
                                } else {
                                    alert('User canceled login or did not fully authorize.');
                                }
                            }, {
                                scope: 'ads_read,ads_management,read_insights',
                                return_scopes: true,
                                enable_profile_selector: true
                            });
                            // });

                            return false;
                        };
                        window.fbAsyncInit = function() {
                            FB.init({
                                appId: "630037578026405",
                                cookie: true,
                                version: "v12.0"
                            });
                        };
                        (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) {
                                return;
                            }
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "https://connect.facebook.net/en_US/sdk.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>
                    <script src="https://app.yazey.com/js/facebook-ads.js "></script>
                    <script src="https://app.yazey.com/js/pages/features/miscellaneous/sweetalert2.js"></script>

                    <script>
                        $(document).ready(function() {
                            $(document).on("click", "#facebook-ads-table .btn-delete", function(e) {
                                e.preventDefault();
                                let href = $(this).attr('href')
                                swal.fire({
                                    title: "Are you sure?",
                                    text: "This operation will not be unrecoverable ",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Delete",
                                    cancelButtonText: "Cancel",
                                    reverseButtons: true
                                }).then(function(result) {
                                    if (result.value) {
                                        swal.fire(
                                            "Deleted!",
                                            "",
                                            "success"
                                        )
                                        window.location.href = href
                                        // result.dismiss can be "cancel", "overlay",
                                        // "close", and "timer"
                                    } else if (result.dismiss === "cancel") {
                                        swal.fire(
                                            "Cancelled",
                                            ":)",
                                            "error"
                                        )
                                    }
                                });
                            });
                        })
                    </script>
                    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
                    <!--  <script>-->
                    <!--$(document).ready(function(){-->
                    <!--     $(window).scroll(function () {-->
                    <!--            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {-->
                    <!--                load_data();-->
                    <!--            }-->
                    <!--        });-->

                    <!-- function load_data()-->
                    <!-- {-->
                    <!--    var _token = $('input[name="_token"]').val();-->
                    <!--  var id = $('.ajaxdata').last().attr("data-id");-->
                    <!--  $.ajax({-->
                    <!--   url:"https://app.yazey.com/load_more",-->
                    <!--   method:"POST",-->
                    <!--   data:{id:id, _token:_token},-->
                    <!--   success:function(data)-->
                    <!--   {-->
                    <!--    $('#load_more_button').html('<b>Load More</b>');-->
                    <!--    $('#post_data').html(data);-->
                    <!--   }-->
                    <!--  })-->
                    <!-- }-->

                    <!--});-->
                    <!--</script>-->

                </div>
            </div>
        </div>

        <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">

            <div class=" container-fluid  d-flex flex-column flex-md-row align-items-center justify-content-between">

                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted font-weight-bold mr-2 text-dark-75 text-hover-primary"> &copy; 2022 Eastplayers</span>
                </div>


                <div class="nav nav-dark order-1 order-md-2">
                    <a href="https://eastplayers.io/#our-team" class="nav-link px-3">About Us</a>
                    <a href="https://eastplayers.io/contact" class="nav-link px-3">Contact</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>






<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">

    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            User Profile
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>


    <div class="offcanvas-content pr-5 mr-n5">

        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('https://app.yazey.com/images/logo.png')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    <?=$domain?>
                </a>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								<span class="svg-icon svg-icon-lg svg-icon-primary"><!--begin::Svg Icon | path:media/svg/icons/Communication/Mail-notification.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"/>
        <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
    </g>
</svg><!--end::Svg Icon--></span>
							</span>
                            <span class="navi-text text-muted text-hover-primary">payyoumy2018@gmail.com</span>
                        </span>
                    </a>
                    <a href="https://app.yazey.com/logout" class="btn btn-light-primary font-weight-bold">Logout</a>
                </div>
            </div>
        </div>


        <div class="separator separator-dashed mt-8 mb-5"></div>


        <div class="navi navi-spacer-x-0 p-0">

            <a href="https://app.yazey.com/my-profile" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
							<span class="svg-icon svg-icon-md svg-icon-success"><!--begin::Svg Icon | path:media/svg/icons/General/Notification2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"/>
        <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
    </g>
</svg><!--end::Svg Icon--></span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            My Profile
                        </div>
                        <div class="text-muted">
                            Account settings and more
                            <span class="label label-light-danger label-inline font-weight-bold">update</span>
                        </div>
                    </div>
                </div>
            </a>

        </div>

    </div>
</div>




<div id="kt_scrolltop" class="scrolltop">
	<span class="svg-icon"><!--begin::Svg Icon | path:media/svg/icons/Navigation/Up-2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>

</div>


<div class="modal" id="comming-soon">
    <div class="modal-overlay modal-toggle"></div>
    <div class="modal-wrapper modal-transition">
        <div class="modal-header">
            <button class="modal-close modal-toggle">&#x2715</button>
        </div>

        <div class="modal-body">
            <div class="modal-content">
                <div class="section__table">
                    <img src="https://app.yazey.com/images/comming-soon.jpg" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var HOST_URL = "https://app.yazey.com/quick-search";
</script>


<!-- <script>
    var KTAppSettings = {
        !!json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!
    };
</script> -->


<script src="https://app.yazey.com/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="https://app.yazey.com/plugins/custom/prismjs/prismjs.bundle.js" type="text/javascript"></script>
<script src="https://app.yazey.com/js/scripts.bundle.js" type="text/javascript"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>    <script type="text/javascript">toastr.options = {"closeButton":true,"closeClass":"toast-close-button","closeDuration":300,"closeEasing":"swing","closeHtml":"<button><i class=\"icon-off\"><\/i><\/button>","closeMethod":"fadeOut","closeOnHover":true,"containerId":"toast-container","debug":false,"escapeHtml":false,"extendedTimeOut":10000,"hideDuration":1000,"hideEasing":"linear","hideMethod":"fadeOut","iconClass":"toast-info","iconClasses":{"error":"toast-error","info":"toast-info","success":"toast-success","warning":"toast-warning"},"messageClass":"toast-message","newestOnTop":false,"onHidden":null,"onShown":null,"positionClass":"toast-top-right","preventDuplicates":true,"progressBar":true,"progressClass":"toast-progress","rtl":false,"showDuration":300,"showEasing":"swing","showMethod":"fadeIn","tapToDismiss":true,"target":"body","timeOut":5000,"titleClass":"toast-title","toastClass":"toast"};</script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        let flag = true
        $(document).on('click', '.drop-logout', function() {
            $(this).parent().find('.dropdown-menu-right').toggleClass('button-logout')
        })
    })
</script>


<script src="/js/pages/features/charts/apexcharts.js"></script>
<script>
    jQuery(".connect_data").click(function() {
        jQuery('#loader').show();
        $.ajax({
            type: 'GET',
            url: '/updatefacebookdata',
            data: '_token = BIVcyVxnaO8kMb2lqe7kQUayL9yz60HcB62KqA2L',
            success: function(response) {

                jQuery('#loader').hide();
                toastr.success('Synchronization is completed successfully', '');
                window.location.href = "/dashboard";

            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        //to disable the entire page
        $("body").on("contextmenu",function(e){
            return false;
        });
        
        //to disable a section
        $(".firsttable").on("contextmenu",function(e){
            return false;
        });

        $('body').bind('cut copy paste', function (e) {
            e.preventDefault();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('body').css('display', 'none');
        $('body').fadeIn(2500);

        function newPage() {
            window.location = newLocation;
        }
    });
</script>
<script>
    // popup coming soon

    jQuery('.modal-toggle').on('click', function(e) {
        e.preventDefault();
        jQuery('#comming-soon').toggleClass('is-visible');
        jQuery('html,body').animate({
            scrollTop: 0
        }, 0);
    });

    jQuery('.connect-agency').on('click', function(e) {
        e.preventDefault();
        jQuery('#agency_connect_modal').toggleClass('is-visible');
        $('.thankyoumsg').hide();
        $('#payment-agree-box').show();
        $('#payment-form').hide();
        jQuery('html,body').animate({
            scrollTop: 0
        }, 0);
    });
</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    function marketingroas() {
        $("#mros").addClass("active");
        $("#ms").removeClass("active");
        $("#cpc").removeClass("active");
    }

    function monthlysales() {
        $("#mros").removeClass("active");
        $("#ms").addClass("active");
        $("#cpc").removeClass("active");
    }

    function cpcsales() {
        $("#mros").removeClass("active");
        $("#ms").removeClass("active");
        $("#cpc").addClass("active");
    }
</script>


<script>
    window.intercomSettings = {
        api_base: "https://api-iam.intercom.io",
        app_id: "jbj0c34v"
    };
</script>

<script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/jbj0c34v'
    (function() {
        var w = window;
        var ic = w.Intercom;
        if (typeof ic === "function") {
            ic('reattach_activator');
            ic('update', w.intercomSettings);
        } else {
            var d = document;
            var i = function() {
                i.c(arguments);
            };
            i.q = [];
            i.c = function(args) {
                i.q.push(args);
            };
            w.Intercom = i;
            var l = function() {
                var s = d.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://widget.intercom.io/widget/jbj0c34v';
                var x = d.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            };
            if (document.readyState === 'complete') {
                l();
            } else if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();
</script>
</body>
</html>
<?php } else { header('Location:/fakeDashboard');} ?>