/**
 * TODO: Pre-loaders, re-ordering and a general tidy up
 */
$(document).ready(function(){

    var animatePercent = function() {
        $("#percentage_bar > span").each(function() {
            $(this).data("origWidth", $(this).width())
                .width(0)
                .animate({
                        width: $(this).data("origWidth")
                }, 1200);
        });
    };

	var updatePercent = function(value) {
		$('#percentage_bar span').animate({width: value+'%'},1200);
        $('#percentage_bar span').attr('title', value + '%');
	};
	
	var sortListNumbers = function() {
			
		var currentNum = 0;
		
		$("#list .id").each(function() {
			if (parseInt($(this).text()) != parseInt(currentNum)+1) {
				$(this).text(parseInt(currentNum)+1 +'.');
                currentNum++;
			} else {
				currentNum = parseInt($(this).text());
			}
		});

	};
    
    var addLatestItemNode = function() {
        // Do ajax save, following needs to then be in the callback
        $.get('' + CI.base_url + 'lists/getLatestItemHTML', 'ajax=1', function(new_item) {            
            if (new_item) {
                $(new_item).hide().appendTo('#list').fadeIn();
            }
        });        
    };
	
    /**
     * Turn list title editing on for convenience for now, will work differently
     * in long run
     */
	$('.list_title.editable').editable(CI.base_url + 'lists/edit/' + CI.listId + '/list_title', {        
		cancel: 'Cancel',
		submit: 'Save',
		name: 'list_title',
		cssclass: 'editable',
		tooltip: 'Click to edit (use [total] for total of number of items)',
        submitdata: {ajax:1}       
    });   
	
	$('#list span.title.editable').editable(CI.base_url + 'lists/edit/' + CI.listId + '/title', {
		cancel: 'Cancel',
		submit: 'Save',
		name: 'title',
		cssclass: 'editable',
		tooltip: 'Click to edit',
        submitdata: {ajax:1}
	});
	
	$("#list span.comments.editable").editable(CI.base_url + 'lists/edit/' + CI.listId + '/comments', {
		type: 'textarea',
		rows: '5',
		cancel: 'Cancel',
		submit: 'Save',
		name: 'comments',
		cssclass: 'editable',
		tooltip: 'Click to edit',
        submitdata: {ajax:1}       
	});		
	
    // Mark an item as complete/uncomplete
	$("#list .status a").live('click', function(e) {
        e.preventDefault();

        var link = this;
        var is_done = 1;
        var new_text = '<img src="' + CI.base_url + 'images/uncomplete.png" alt="Uncomplete" class="uncomplete-icon" />';
        var new_url = $(this).attr('href');
        var add_remove_class = 'add';

        if ($(this).children(0).attr('class') == 'uncomplete-icon') {
            var is_done = 0;
            var new_text = '<img src="' + CI.base_url + 'images/complete.png" alt="Complete" class="complete-icon" />';
            var new_url = $(this).attr('href').replace('uncomplete', 'complete');
            var add_remove_class = 'remove';
        }

        if ($(this).children(0).attr('class') == 'complete-icon') {
            var new_url = $(this).attr('href').replace('complete', 'uncomplete');                        
        }

        // Do ajax save, following needs to then be in the callback
        $.get($(this).attr('href'), 'ajax=1', function(percent) {
            if (percent) {
                if (add_remove_class == 'add') {
                    $(link).parent().prev().addClass('done');
                } else {
                    $(link).parent().prev().removeClass('done');
                }
                $(link).html(new_text);
                $(link).attr('href', new_url);
                updatePercent(percent);
            }
        });
    });

    // Add an item
    $(".add_item").live('click',function(e) {
        e.preventDefault();
        // Do ajax save, following needs to then be in the callback
        $.get($(this).attr('href'), 'ajax=1', function(percent) {
            addLatestItemNode();
            updatePercent(percent);            
        });
    });

    // Delete an item
	$("#list .delete a").live('click', function(e) {
        e.preventDefault();

        var link = this;

        $.get($(this).attr('href'), 'ajax=1', function(percent) {
            if (percent) {
                $(link).parent().parent().fadeOut(500, function() { 
                    $(this).remove()
                    updatePercent(percent);
                    sortListNumbers();                    
                });
            }
        });

	});

});