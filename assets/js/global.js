
	jQuery(document).ready(function($) {

		$( "#sortable" ).sortable({
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).disableSelection();

		$('.btn_submit').bind('click', function() {
			$('#frm_rules_form').submit();
			return false;
		});

		$('.btn_flag_on_off').bind('click', function() {
			if ($('#flag_on_off').val() == '')
				$('#flag_on_off').val(1);
			else
				$('#flag_on_off').val('');

			$('#frm_rules_form').submit();
			return false;
		});


		$('.btn_add_item').bind('click', function() {

			//CHECK IF THE THEME HAS BEEN SELECTED AND IF AT LEAST ONE OPTION FOR FILTER TOO
			if ($('#cmb_source').val() == '' &&
				$('#cmb_device').val() == '' &&
				$('#cmb_os').val() == '' &&
				$('#cmb_browser').val() == ''
				)
			{
				alert('You must select at least one filter for the Rule');
				return false;
			}

			if ($('#cmb_theme').val() == '')
			{
				alert('You must select the Theme for the Rule');
				return false;
			}

			//CLONE THE NEW ROW ELEMENT (TEMPLATE)
			new_row = $('#empty_row').clone();

			//SET THE VALUES ON THIS NEW ROW
			$(new_row).find('.data_source').html($('#cmb_source').val());
			$(new_row).find('.data_device').html($('#cmb_device').val());
			$(new_row).find('.data_os').html($('#cmb_os').val());
			$(new_row).find('.data_browser').html($('#cmb_browser').val());
			$(new_row).find('.data_theme').html($('#cmb_theme').val());

			$(new_row).find('.field_data_source').val($('#cmb_source').val());
			$(new_row).find('.field_data_device').val($('#cmb_device').val());
			$(new_row).find('.field_data_os').val($('#cmb_os').val());
			$(new_row).find('.field_data_browser').val($('#cmb_browser').val());
			$(new_row).find('.field_data_theme').val($('#cmb_theme').val());

			$('#rules_table tbody').last().append('<tr>' + $(new_row).html() + '</tr>');

			//REBIND ALL FIELDS
			bind_fields();

			validate_empty_row_message();

			//CLEAN THE FIELDS IN THE CLONE BLOCK
			//clear_block(data_block_clone);

			return false;
		});

		function bind_fields()
		{

			//FIRST UNBIND THE ELEMENTS THEN BIND AGAIN TO AVOID MULTIPLE BINDINGS
			$('.btn_remove_item').unbind('click');
			$('.btn_remove_item').bind('click', function() {

				$(this).parents('tr').remove();

				validate_empty_row_message();

				return false;
			});

		}

		function validate_empty_row_message()
		{
			row_count = $('#rules_table tbody').find('tr').length;
			if (row_count == 2)
				$('#empty_row_message').show();
			else
				$('#empty_row_message').hide();
		}



		bind_fields();

	});
