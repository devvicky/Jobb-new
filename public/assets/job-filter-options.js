(function($) {

	$(document).ready( function() {

		$("body").on('click', '.job-type-checkbox', function(e) {
			var modal = $(this).parents('.modal');
			modal.find('.job-type-do-not-change').remove();
			var checkboxes = modal.find(".job-type-checkbox").find('input[type="checkbox"]:checked');
			var thisCheckbox = $(this).find('input[type="checkbox"]'); 
			if (thisCheckbox.is(':checked') && checkboxes.length == 1) {
				$(this).parents('.row').before('<p class="job-type-do-not-change text-danger">Atlease one job type required.</p>');
				return false; 
			} 
		});

		$("body").on('click', '.show-advanced-filter-setting', function(e) {
			var modal = $(this).parents('.modal');
			var elm = $(this);
			modal.find('.advanced-filter-setting').slideDown(200, function() {
				elm.removeClass('show-advanced-filter-setting').addClass('hide-advanced-filter-setting').text("Hide advanced filter");
			});
		});

		$("body").on('click', '.hide-advanced-filter-setting', function(e) {
			var modal = $(this).parents('.modal');
			var elm = $(this);
			modal.find('.advanced-filter-setting').slideUp(200, function() {
				elm.removeClass('hide-advanced-filter-setting').addClass('show-advanced-filter-setting').text("Show advanced filter");
			});
		});
var skillselect = $("#skill-industry").select2({}); 
	});
})(jQuery);