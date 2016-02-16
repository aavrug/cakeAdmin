jQuery(document).ready(function(){
	$('#search-db-name').keyup(function (e) {
    	var searchText = $(this).val();
    	$("#sidebar li a").show();
    	$("#sidebar li a:not(:contains("+searchText+"))").hide();
    });

	if ($('#tables-data').length > 0) {
		$('#tables-data td').dblclick(function (e) {
			var text 	   = $(this).text();
			$(this).attr('data-previous', text);
			var inputField = '<input type="text" class="form-control" id="td-input" value="'+text+'">';
			$(this).empty().append(inputField);
	    });

	    $(document).click(function (e) {
	    	if ($('#td-input').length > 0) {
				var selectedId = $('#td-input').closest('td').attr('id');
				var closestTdId = $('#'+e.target.id).closest('td').attr('id');
				if (closestTdId == selectedId) {
					return;
				} else {
					var text = $('#'+selectedId).attr('data-previous');
					var inputText = $('#td-input').val();
					$('td#'+selectedId).empty().text(inputText);
					if (inputText != text) {
						var fieldName  = $('#'+selectedId).attr('data-field');
						var id 		   = $('#'+selectedId).parent('tr').attr('id');
						var dbname 	   = $('#dbname').val();
						var tablename  = $('#tablename').val();
						$.ajax({
						  url: "/Tables/update_row",
						  method: "POST",
						  data: { id : id, fieldName : fieldName, newValue : inputText, dbname : dbname, tablename : tablename },
						  dataType: "html"
						}).done(function( response ) {
							var response = JSON.parse(response);
							$('.main div.alert').remove();
							if (response.result) {
								var successMsg = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>The value changed from <strong>'+text+'</strong> to <strong>'+inputText+'</strong> for field <strong>'+fieldName+'</strong>.</div>';
								$('.main .table-responsive').prepend(successMsg);
							} else {
								$('td#'+selectedId).empty().text(text);
								var errorMsg = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+response.msg+'.</div>';
								$('.main .table-responsive').prepend(errorMsg);
							}
						}).fail(function( jqXHR, textStatus ) {
							$('.main div.alert').remove();
							var errorMsg = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>There is something wrong.</div>';
							$('.main .table-responsive').prepend(errorMsg);
						});
					
					}
				}
	    		
	    	}

		});
	}



});