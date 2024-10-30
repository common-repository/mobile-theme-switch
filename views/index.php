
	<form name="frm_rules_form" id="frm_rules_form" method="post" action="">

		<input type="hidden" value="1" name="form_submit">
		<input type="hidden" value="<?php echo $flag_on_off?>" name="flag_on_off" id="flag_on_off">

		<div style="border:0px solid #CCCCCC; width:820px;">

			<?php if ($flag_updated == 1):?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Succes!</strong> Your rules have been updated!
				</div>
			<?php endif;?>

			<div class="pagination-centered" style="padding-bottom:10px;">
				<?php if (empty($flag_on_off)):?>
					<button class="btn btn-large btn-primary btn-danger btn_flag_on_off" type="button">Swich Rules is <strong>OFF</strong>! Click to switch ON!</button>
				<?php else:?>
					<button class="btn btn-large btn-primary btn-success btn_flag_on_off" type="button">Swich Rules is <strong>ON</strong>! Click to switch OFF!</button>
				<?php endif;?>
			</div>

			<div class="tabbable">

				<div class="tab-content" style="padding:10px; border:1px solid #CCCCCC;">
					<div class="tab-pane active" id="tab1">

						<fieldset class="parameter_container" style="position:relative">
							<legend>Rules</legend>
							<div class="data_block">

								<table>
									<tr>
										<td>
											When using a
											<select name="cmb_source" id="cmb_source">
												<option value="">Choose one</option>
												<option value="Mobile">Mobile</option>
												<option value="Tablet">Tablet</option>
											</select>
										</td>
										<td align="right">
											as
											<select name="cmb_device" id="cmb_device">
												<option value="">Any Device</option>
												<optgroup label="Mobile Phones">
												<?php foreach ($phone_devices as $device_name => $device_value):?>
													<option value="<?php echo $device_name?>"><?php echo $device_name?></option>
												<?php endforeach;?>
												<optgroup label="Tablets">
												<?php foreach ($tablet_devices as $device_name => $device_value):?>
													<option value="<?php echo $device_name?>"><?php echo $device_name?></option>
												<?php endforeach;?>
											</select>
										</td>
										<td align="right">
											running
											<select name="cmb_os" id="cmb_os">
												<option value="">Any OS</option>
												<?php foreach ($operating_systems as $operating_system_name => $operating_system_value):?>
													<option value="<?php echo $operating_system_name?>"><?php echo $operating_system_name?></option>
												<?php endforeach;?>
											</select>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="right">
											with
											<select name="cmb_browser" id="cmb_browser">
												<option value="">Any Browser</option>
												<?php foreach ($user_agents as $user_agents_name => $user_agents_value):?>
													<option value="<?php echo $user_agents_name?>"><?php echo $user_agents_name?></option>
												<?php endforeach;?>
											</select>
										</td>
										<td align="right">
											use Theme
											<select name="cmb_theme" id="cmb_theme">
												<option value="">Select the Theme</option>
												<?php foreach ($themes as $theme_slug => $theme_data):?>
													<option value="<?php echo $theme_slug?>"><?php echo $theme_data["Name"]?> v<?php echo $theme_data["Version"]?></option>
												<?php endforeach;?>
											</select>
										</td>
									</tr>
								</table>

								<div style="clear:both"></div>

							</div>

							<div class="pagination-centered">
								<a class="btn btn-small btn_add_item" href="#"><i class="icon-plus-sign"></i> Add Rule</a>
							</div>

						</fieldset>

						<div style="clear:both"></div>

						<br>

						<table id="rules_table" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
							<thead>
								<tr>
									<th colspan="10" style="background: #dff0d8">Current Rules (rules are applied in the order displayed here)</th>
								</tr>
								<tr>
									<th width=30>&nbsp;</th>
									<th width=30>&nbsp;</th>
									<th>Source</th>
									<th>Device</th>
									<th>OS</th>
									<th>Browser</th>
									<th>Theme</th>
								</tr>
							</thead>
							<tbody id="sortable">
								<?php if (!empty($rules)):?>
									<?php foreach ($rules as $rule):?>

									<tr>
										<input type="hidden" name="source[]" value="<?php echo $rule["source"]?>">
										<input type="hidden" name="device[]" value="<?php echo $rule["device"]?>">
										<input type="hidden" name="os[]" value="<?php echo $rule["os"]?>">
										<input type="hidden" name="browser[]" value="<?php echo $rule["browser"]?>">
										<input type="hidden" name="theme[]" value="<?php echo $rule["theme"]?>">
										<td><i class="icon-move table_move_cell"></i></td>
										<td><a class="btn btn-small btn_remove_item" href="#"><i class="icon-minus-sign"></i></a></td>
										<td><?php echo $rule["source"]?>&nbsp;</td>
										<td><?php echo $rule["device"]?>&nbsp;</td>
										<td><?php echo $rule["os"]?>&nbsp;</td>
										<td><?php echo $rule["browser"]?>&nbsp;</td>
										<td><?php echo $rule["theme"]?>&nbsp;</td>
									</tr>
									<?php endforeach;?>
								<?php endif;?>

								<?php if (!empty($rules)):?>
									<tr style="display:none" id="empty_row_message"><td colspan="10" style="text-align:center; color:#FF0000; font-weight:bold;">No Rules defined</td></tr>
								<?php else:?>
									<tr id="empty_row_message"><td colspan="10" style="text-align:center; color:#FF0000; font-weight:bold;">No Rules defined</td></tr>
								<?php endif;?>

								<tr style="display:none" id="empty_row">
									<input type="hidden" name="source[]" class="field_data_source" value="">
									<input type="hidden" name="device[]" class="field_data_device" value="">
									<input type="hidden" name="os[]" class="field_data_os" value="">
									<input type="hidden" name="browser[]" class="field_data_browser" value="">
									<input type="hidden" name="theme[]" class="field_data_theme" value="">
									<td><i class="icon-move table_move_cell"></i></td>
									<td><a class="btn btn-small btn_remove_item" href="#"><i class="icon-minus-sign"></i></a></td>
									<td class="data_source">&nbsp;</td>
									<td class="data_device">&nbsp;</td>
									<td class="data_os">&nbsp;</td>
									<td class="data_browser">&nbsp;</td>
									<td class="data_theme">&nbsp;</td>
								</tr>

							</tbody>
						</table>

						<div class="pagination-centered">
							<a class="btn btn_submit" href="#" rel="1">Save Rules <i class="icon-ok"></i></a>
						</div>
							
					</div>
				</div>
			</div>

		</div>

	</form>
