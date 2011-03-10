$(document).ready(function(){

	var updatePercent = function(value) {
		
		$('#percentage_bar span').css({width: value + '%'}).text(value + '%');
	}
	
	var sortListNumbers = function() {
			
		var currentNum = 0;
		
		$("#list tr td.id").each(function() {
			if ($(this).text() != parseInt(currentNum)+1) {
				$(this).text(parseInt(currentNum)+1);
			} else {
				currentNum = $(this).text();
			}
		});

	}
	
	$(".list_title").editable('index.php', {
		cancel: 'Cancel',
		submit: 'Save',
		name: 'list_title',
		cssclass: 'editable',
		tooltip: 'Click to edit (use [total] for total of number of items)'
	});
	
	$("#list tr td span.title").editable('index.php', {
		cancel: 'Cancel',
		submit: 'Save',
		name: 'title',
		cssclass: 'editable',
		tooltip: 'Click to edit'
	});
	
	$("#list tr td span.comments").editable('index.php', {
		type: 'textarea',
		rows: '5',
		cancel: 'Cancel',
		submit: 'Save',
		name: 'comments',
		cssclass: 'editable',
		tooltip: 'Click to edit'
	});		
	
	$("#list tr td.status a").live('click',
		function(e) {
			e.preventDefault();

			var ids = $(this).attr('class').split('_');
			var itemID = ids[1]

			var link = this;
			var is_done = 1;
			var new_text = 'Uncomplete';
			var add_remove_class = 'add';

			if ($(this).text() == 'Uncomplete') {
				var is_done = 0;
				var new_text = 'Complete';
				var add_remove_class = 'remove';
			}

			// Do ajax save, following needs to then be in the callback
			$.get('index.php', 'ajax=1&id='+ itemID + '&is_done=' + is_done, function(percent) {
				if (percent) {
					if (add_remove_class == 'add') {
						$(link).parent().prev().addClass('done');
					} else {
						$(link).parent().prev().removeClass('done');
					}
					$(link).text(new_text);
					updatePercent(percent);
				}
			});
		});

    // Add an item
    $("#add_item").live('click',function(e) {
        e.preventDefault();
        // Do ajax save, following needs to then be in the callback
        $.get('index.php', 'ajax=1&add_item=1', function(new_item) {
            if (new_item) {
                $('#list').append(new_item);
            }
        });
    });

    // Delete an item
	$("#list tr td.delete a").live('click',
		function(e) {
			e.preventDefault();

			var ids = $(this).attr('class').split('_');
			var itemID = ids[1]
			var link = this;

			$.get('index.php', 'ajax=1&id='+ itemID + '&delete_item=1', function(percent) {
				if (percent) {
					$(link).parent().parent().remove();
					updatePercent(percent);
					sortListNumbers();
				}
			});

	});

});