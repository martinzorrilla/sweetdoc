<?php
/* Template Name: Event Full Calendar */
get_header();?>

<h2 style="text-align:center">Agendamientos</h2>

<div class="em-full-calendar" style="padding:0 1em;">
	<?php
    if(class_exists('WP_FullCalendar')){
      echo WP_FullCalendar::calendar();
      // echo EM_Calendar::output(array('full'=>0, 'long_events'=>1))
    }	
    ?>
</div>

<?php
get_footer();
