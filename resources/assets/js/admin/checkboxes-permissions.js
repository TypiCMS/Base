function enableTableCheckboxes() {
	// Checkboxes autocochées pour la table des rôles.
	// la table doit comporter thead et tbody et les cellules de thead doivent être des th
	var generate = function(table, direction) {
		var cellsToCheck, selector, selector2, selectorHeadingCells, selectorHeadingCells2;
		if (direction == 'horizontal') {
			cellsToCheck = table.find('tbody td:nth-child(2)');
			selector = 'tr';
			selector2 = ' td';
			selectorHeadingCells = 'tbody tr';
			selectorHeadingCells2 = ' td:first-child';
		} else {
			cellsToCheck = table.find('tbody tr:first td');
			selector = 'td';
			selector2 = '';
			selectorHeadingCells = 'thead th';
			selectorHeadingCells2 = '';
		}
		cellsToCheck.each(function(index) {
			if ($(this).find('input:checkbox').length) {
				// s'il y a une checkbox, ajouter une checkbox dans la première rangée/colonne
				var col, checkbox;
				col = index + 1;
				checkbox = $('<input>')
					.attr('type', 'checkbox')
					.click(function(){
						var checkedStatus = this.checked;
						table.find('tbody ' + selector + ':nth-child(' + col + ')' + selector2 + ' input:checkbox:not(:disabled)').prop('checked', checkedStatus);
					})
				;
				table.find(selectorHeadingCells + ':eq(' + index + ')' + selectorHeadingCells2).wrapInner('<label />').wrapInner('<div class="checkbox" />').find('label').prepend(checkbox);
			}
		});
	};
	var tables = $('.table-checkboxes');
	tables.each(function(index) {
		var table = $(this);
		generate(table, 'vertical');
		generate(table, 'horizontal');
	});
}

!function( $ ){

	"use strict";

	$(function () {

		enableTableCheckboxes();

	});

}( window.jQuery || window.ender );
