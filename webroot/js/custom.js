jQuery(document).ready(function(){
	$('#search-db-name').keyup(function (e) {
    	var searchText = $(this).val();
    	$("#sidebar li a").show();
    	$("#sidebar li a:not(:contains("+searchText+"))").hide();
    });
});