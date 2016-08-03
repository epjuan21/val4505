$(function() {
	// Codigo para las Alertas
	$('.alert--dismissible').append('<button type="button" class="alert-close">X</button>');

	$('.alert-close').on('click',function(){
	  $(this).closest('.alert').hide();
});

// Plung In Select Editable
(function ($) {
	$.extend($.expr[':'], {
		nic: function (elem, i, match, array) {
			return !((elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0);
		}
	});
	$.fn.editableSelect = function (options) {
		var defaults = { filter: true, effect: 'default', duration: 'fast', onCreate: null, onShow: null, onHide: null, onSelect: null };
		var select = this.clone(), input = $('<input type="text">'), list = $('<ul class="es-list">');
		options = $.extend({}, defaults, options);
		switch (options.effects) {
			case 'default': case 'fade': case 'slide': break;
			default: options.effects = 'default';
		}
		if (isNaN(options.duration) || options.duration != 'fast' || options.duration != 'slow') options.duration = 'fast';
		this.replaceWith(input);
		var EditableSelect = {
			init: function () {
				var es = this;
				es.copyAttributes(select, input);
				input.addClass('es-input');
				$(document.body).append(list);
				select.find('option').each(function () {
					var li = $('<li>'), option = $(this);
					li.data('value', option.val());
					li.html(option.text());
					es.copyAttributes(this, li);
					list.append(li);
					if ($(this).attr('selected')) input.val(option.text());
				});
				input.on('focus input click', es.show);
				$(document).on('click', function (event) {
					if (!$(event.target).is(input) && !$(event.target).is(list)) es.hide();
				});
				es.initializeList();
				es.initializeEvents();
				if (options.onCreate) options.onCreate.call(this, input);
			},
			initializeList: function () {
				var es = this;
				list.find('li').each(function () {
					$(this).on('mousemove', function () {
						list.find('.selected').removeClass('selected');
						$(this).addClass('selected');
					});
					$(this).on('click', function () { es.setField.call(this, es); });
				});
				list.mouseenter(function () {
					list.find('li.selected').removeClass('selected');
				});
			},
			initializeEvents: function () {
				var es = this;
				input.bind('input keydown', function (event) {
					switch (event.keyCode) {
						case 40: // Down
							es.show();
							var visibles = list.find('li:visible'), selected = visibles.filter('li.selected');
							list.find('.selected').removeClass('selected');
							selected = visibles.eq(selected.size() > 0 ? visibles.index(selected) + 1 : 0);
							selected = (selected.size() > 0 ? selected : list.find('li:visible:first')).addClass('selected');
							es.scroll(selected, true);
							break;
						case 38: // Up
							es.show();
							var visibles = list.find('li:visible'), selected = visibles.filter('li.selected');
							list.find('li.selected').removeClass('selected');
							selected = visibles.eq(selected.size() > 0 ? visibles.index(selected) - 1 : -1);
							(selected.size() > 0 ? selected : list.find('li:visible:last')).addClass('selected');
							es.scroll(selected, false);
							break;
						case 13: // Enter
							if (list.is(':visible')) {
								es.setField.call(list.find('li.selected'), es);
								event.preventDefault();
							}
						case 9:  // Tab
						case 27: // Esc
							es.hide();
							break;
						default:
							es.show();
							break;
					}
				});
			},
			show: function () {
				list.find('li').show();
				list.css({ top: input.offset().top + input.outerHeight() - 1, left: input.offset().left, width: input.innerWidth() });
				var hidden = options.filter ? list.find('li:nic(' + input.val() + ')').hide().size() : 0;
				if (hidden == list.find('li').size()) list.hide();
				else
					switch (options.effects) {
						case 'fade':   list.fadeIn(options.duration); break;
						case 'slide':  list.slideDown(options.duration); break;
						default:       list.show(options.duration); break;
					}
				if (options.onShow) options.onShow.call(this, input);
			},
			hide: function () {
				switch (options.effects) {
					case 'fade':   list.fadeOut(options.duration); break;
					case 'slide':  list.slideUp(options.duration); break;
					default:       list.hide(options.duration); break;
				}
				if (options.onHide) options.onHide.call(this, input);
			},
			scroll: function (selected, up) {
				var height = 0, index = list.find('li:visible').index(selected);
				list.find('li:visible').each(function (i, element) { if (i < index) height += $(element).outerHeight(); });
				if (height + selected.outerHeight() >= list.scrollTop() + list.outerHeight() || height <= list.scrollTop()) {
					if (up) list.scrollTop(height + selected.outerHeight() - list.outerHeight());
					else list.scrollTop(height);
				}
			},
			copyAttributes: function (from, to) {
				var attrs = $(from)[0].attributes;
				for (var i in attrs) $(to).attr(attrs[i].nodeName, attrs[i].nodeValue);
			},
			setField: function (es) {
				if (!$(this).is('li:visible')) return false;
				input.val($(this).text());
				es.hide();
				if (options.onSelect) options.onSelect.call(input, $(this));
			}
		};
		EditableSelect.init();
		return input;
	}
}) (jQuery);


$('#editable-select').editableSelect({ effects: 'slide',filter: false });
$('#editable-select2').editableSelect({ effects: 'slide',filter: false });
$('#editable-select3').editableSelect({ effects: 'slide',filter: false });
$('#editable-select4').editableSelect({ effects: 'slide',filter: false });
$('#editable-select5').editableSelect({ effects: 'slide',filter: false });
$('#editable-select6').editableSelect({ effects: 'slide',filter: false });
$('#editable-select7').editableSelect({ effects: 'slide',filter: false });
$('#editable-select8').editableSelect({ effects: 'slide',filter: false });
$('#editable-select9').editableSelect({ effects: 'slide',filter: false });
$('#editable-select10').editableSelect({ effects: 'slide',filter: false });
$('#editable-select11').editableSelect({ effects: 'slide',filter: false });
$('#editable-select12').editableSelect({ effects: 'slide',filter: false });
$('#editable-select13').editableSelect({ effects: 'slide',filter: false });
$('#editable-select14').editableSelect({ effects: 'slide',filter: false });
$('#editable-select15').editableSelect({ effects: 'slide',filter: false });
$('#editable-select16').editableSelect({ effects: 'slide',filter: false });
$('#editable-select17').editableSelect({ effects: 'slide',filter: false });
$('#editable-select18').editableSelect({ effects: 'slide',filter: false });
$('#editable-select19').editableSelect({ effects: 'slide',filter: false });
$('#editable-select20').editableSelect({ effects: 'slide',filter: false });
$('#editable-select21').editableSelect({ effects: 'slide',filter: false });
$('#editable-select22').editableSelect({ effects: 'slide',filter: false });
$('#editable-select23').editableSelect({ effects: 'slide',filter: false });
$('#editable-select24').editableSelect({ effects: 'slide',filter: false });
$('#editable-select25').editableSelect({ effects: 'slide',filter: false });
$('#editable-select26').editableSelect({ effects: 'slide',filter: false });
$('#editable-select27').editableSelect({ effects: 'slide',filter: false });
$('#editable-select28').editableSelect({ effects: 'slide',filter: false });
$('#editable-select29').editableSelect({ effects: 'slide',filter: false });
$('#editable-select30').editableSelect({ effects: 'slide',filter: false });
$('#editable-select31').editableSelect({ effects: 'slide',filter: false });
$('#editable-select32').editableSelect({ effects: 'slide',filter: false });
$('#editable-select33').editableSelect({ effects: 'slide',filter: false });
$('#editable-select34').editableSelect({ effects: 'slide',filter: false });
$('#editable-select35').editableSelect({ effects: 'slide',filter: false });
$('#editable-select36').editableSelect({ effects: 'slide',filter: false });
$('#editable-select37').editableSelect({ effects: 'slide',filter: false });
$('#editable-select38').editableSelect({ effects: 'slide',filter: false });
$('#editable-select39').editableSelect({ effects: 'slide',filter: false });
$('#editable-select40').editableSelect({ effects: 'slide',filter: false });

});

	$('#chooseFile').bind('change', function () {
	  var filename = $("#chooseFile").val();

	  if (/^\s*$/.test(filename)) {
	    $(".file-upload").removeClass('active');
	    $("#noFile").text("Ningún Archivo Seleccionado..."); 
	  }
	  else {
	    $(".file-upload").addClass('active');
	    $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
	  }
});