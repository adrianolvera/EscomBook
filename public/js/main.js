The MIT License (MIT)
 
Copyright (c) 2014 Ali Gajani (http://www.aligajani.com)
 
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 
$(window).load(function () {
 
//Infinite Scroll Ajax
$(document).ready(function ($) {
 
//to get the max page, I suggest to output the result via an API call
var api = "http://localhost:8000" + "/api/v1/collection";
 
$.getJSON(api, function (json) {
var max_page = json.collection['last_page'];
var count = 2;
var total = max_page;
 
//when user reaches bottom of the page, make an ajax request
$(window).scroll(function () {
if ($(window).scrollTop() == $(document).height() - $(window).height()) {
if (count > total) {
return false;
} else {
loadFeed(count);
}
count++;
}
});
 
});
 
//the ajax request comes here with the page number
function loadFeed(pageNumber) {
 
//display the ajax loader while things load
$('a#inifiniteLoader').show('fast');
 
//get the current url
var curURL = window.location.href;
 
//the actual ajax request happens here
$.ajax({
 
//these query strings must look familiar by now
url: curURL + "?page=%",
 
//perform a GET request with the data
type: 'GET',
data: {page: pageNumber},
 
//when there is an output
success: function (html) {
$('a#inifiniteLoader').hide('1000');
 
//you need to manipulate the DOM by filtering via class
var items = $(html).find(".ajax_scroll").html();
 
//don't render if there are no items
render(items);
 
}
});
return false;
}
 
//once items are loaded, now render them in HTML
function render(item_html) {
 
var el = jQuery(item_html);
 
//this makes the masonry animation happen
$('.ajax_scroll').append(el).masonry('appended', el, true);
 
}
 
});
});