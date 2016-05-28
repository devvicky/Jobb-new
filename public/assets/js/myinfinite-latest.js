(function(){
$('#post-items').jscroll({
    loadingHtml: '<img src="/assets/loader.gif" alt="Loading" /> Loading...',
    navSelector  : "#job .pagination",
	nextSelector : "#job .pagination li.active + li a",
	itemSelector : ".post-item",
    path: function(index) {
            return "?page=" + index;
        }
});
});
