<?php
/* WARNING! This file may change in the near future as we intend to add features to the event editor. If at all possible, try making customizations using CSS, jQuery, or using our hooks and filters. - 2012-02-14 */
/* 
 * To ensure compatability, it is recommended you maintain class, id and form name attributes, unless you now what you're doing. 
 * You also must keep the _wpnonce hidden field in this form too.
 */
global $EM_Event, $EM_Notices, $bp;

//check that user can access this page
if( is_object($EM_Event) && !$EM_Event->can_manage('edit_events','edit_others_events') ){
	?>
	<div class="wrap"><h2><?php esc_html_e('Unauthorized Access','events-manager'); ?></h2><p><?php echo sprintf(__('You do not have the rights to manage this %s.','events-manager'),__('Event','events-manager')); ?></p></div>
	<?php
	return false;
}elseif( !is_object($EM_Event) ){
	$EM_Event = new EM_Event();
}
$required = apply_filters('em_required_html','<i>*</i>');

echo $EM_Notices;
//Success notice
if( !empty($_REQUEST['success']) ){
	if(!get_option('dbem_events_form_reshow')) return false;
}
?>	
<form enctype='multipart/form-data' id="event-form" class="em-event-admin-editor <?php if( $EM_Event->is_recurring() ) echo 'em-event-admin-recurring' ?>" method="post" action="<?php echo esc_url(add_query_arg(array('success'=>null, 'action'=>null))); ?>">
	<div class="wrap">
		<?php do_action('em_front_event_form_header', $EM_Event); ?>
		<?php if(get_option('dbem_events_anonymous_submissions') && !is_user_logged_in()): ?>
			<h3 class="event-form-submitter"><?php esc_html_e( 'Your Details', 'events-manager'); ?></h3>
			<div class="inside event-form-submitter">
				<p>
					<label><?php esc_html_e('Name', 'events-manager'); ?></label>
					<input type="text" name="event_owner_name" id="event-owner-name" value="<?php echo esc_attr($EM_Event->event_owner_name); ?>" />
				</p>
				<p>
					<label><?php esc_html_e('Email', 'events-manager'); ?></label>
					<input type="text" name="event_owner_email" id="event-owner-email" value="<?php echo esc_attr($EM_Event->event_owner_email); ?>" />
				</p>
				<?php do_action('em_front_event_form_guest'); ?>
				<?php do_action('em_font_event_form_guest'); //deprecated ?>
			</div>
		<?php endif; ?>
		<h3 class="event-form-name"><?php esc_html_e( 'Nombre del Paciente', 'events-manager'); ?></h3>
		<div class="inside event-form-name">
			<input type="text" name="event_name" id="event-name" value="<?php echo esc_attr($EM_Event->event_name,ENT_QUOTES); ?>" /> <!-- < ?php echo $required; ?> -->
			<br />
			<?php esc_html_e('Ingrese el nombre del paciente', 'events-manager'); ?>
			<?php em_locate_template('forms/event/group.php',true); ?>
		</div>
					
		<h3 class="event-form-when"><?php esc_html_e( 'Fecha', 'events-manager'); ?></h3>
		<div class="inside event-form-when">
		<?php 
			if( empty($EM_Event->event_id) && $EM_Event->can_manage('edit_recurring_events','edit_others_recurring_events') && get_option('dbem_recurrence_enabled') ){
				em_locate_template('forms/event/when-with-recurring.php',true);
			}elseif( $EM_Event->is_recurring()  ){
				em_locate_template('forms/event/recurring-when.php',true);
			}else{
				em_locate_template('forms/event/when.php',true);
			}
		?>
		</div>

		
		<h3 class="event-form-details"><?php esc_html_e( 'Observaciones', 'events-manager'); ?></h3>
		<div class="inside event-form-details">
			<div class="event-editor">
				<?php if( get_option('dbem_events_form_editor') && function_exists('wp_editor') ): ?>
					<?php wp_editor($EM_Event->post_content, 'em-editor-content', array('textarea_name'=>'content') ); ?> 
				<?php else: ?>
					<textarea name="content" rows="10" style="width:100%"><?php echo $EM_Event->post_content ?></textarea>
					<br />
					<?php esc_html_e( 'Informacion adicional para la consulta.', 'events-manager')?>
				<?php endif; ?>
			</div>
			<div class="event-extra-details">
				<?php if(get_option('dbem_attributes_enabled')) { em_locate_template('forms/event/attributes-public.php',true); }  ?>
				<?php if(get_option('dbem_categories_enabled')) { em_locate_template('forms/event/categories-public.php',true); }  ?>
			</div>
		</div>
		
		
		<?php do_action('em_front_event_form_footer', $EM_Event); ?>
	</div>
	<p class="submit">
	    <?php if( empty($EM_Event->event_id) ): ?>
	    <input type='submit' class='btn btn-green botones-estandard' value='<?php echo esc_attr(sprintf( __('Confirmar %s','events-manager'), __('Reserva','events-manager') )); ?>' />
	    <?php else: ?>
	    <input type='submit' class='btn btn-green botones-estandard' value='<?php echo esc_attr(sprintf( __('Actualizar %s','events-manager'), __('Reserva','events-manager') )); ?>' />
	    <?php endif; ?>
	</p>
	<input type="hidden" name="event_id" value="<?php echo $EM_Event->event_id; ?>" />
	<input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('wpnonce_event_save'); ?>" />
	<input type="hidden" name="action" value="event_save" />
	<?php if( !empty($_REQUEST['redirect_to']) ): ?>
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_REQUEST['redirect_to']); ?>" />
	<?php endif; ?>
</form>