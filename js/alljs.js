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
		
		$("#list tr td.id").each(function() {
			if (parseInt($(this).text()) != parseInt(currentNum)+1) {
				$(this).text(parseInt(currentNum)+1 +'.');
                currentNum++;
			} else {
				currentNum = parseInt($(this).text());
			}
		});

	};
	
    /**
     * Turn list title editing on for convenience for now, will work differently
     * in long run
     */
	$(".list_title").editable('main/edit/list_title', {
		cancel: 'Cancel',
		submit: 'Save',
		name: 'list_title',
		cssclass: 'editable',
		tooltip: 'Click to edit (use [total] for total of number of items)',
        submitdata: {ajax:1}
	});
	
	$("#list tr td span.title").editable('main/edit/title', {
		cancel: 'Cancel',
		submit: 'Save',
		name: 'title',
		cssclass: 'editable',
		tooltip: 'Click to edit',
        submitdata: {ajax:1}
	});
	
	$("#list tr td span.comments").editable('main/edit/comments', {
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
	$("#list tr td.status a").live('click', function(e) {
        e.preventDefault();

        var link = this;
        var is_done = 1;
        var new_text = '<img src="images/uncomplete.png" alt="Uncomplete" class="uncomplete-icon" />';
        var new_url = $(this).attr('href');
        var add_remove_class = 'add';

        if ($(this).children(0).attr('class') == 'uncomplete-icon') {
            var is_done = 0;
            var new_text = '<img src="images/complete.png" alt="Complete" class="complete-icon" />';
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
        $.get($(this).attr('href'), 'ajax=1', function(new_item) {
            if (new_item) {
                $(new_item).hide().appendTo('#list').fadeIn();                                    
            }
        });
    });

    // Delete an item
	$("#list tr td.delete a").live('click', function(e) {
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