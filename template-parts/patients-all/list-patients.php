  <?php

  
  $appointment_url = home_url().'/consulta/?patient_id=';

  $search_param = $template_args["search_param"];

  echo "search_param = ".$search_param;

/*  $args = array(
    'numberposts' => -1,
    'post_type'   => 'sw_patient'
  );
  $latest_patients = get_posts( $args );
  wp_reset_postdata();
*/

  $latest_patients = sw_get_patients($search_param);

  ?>
  <?php foreach ($latest_patients as $patient): ?>
      <div data-closable class="callout alert-callout-border primary">
        <a href="<?php echo get_permalink( $patient->ID ); ?> "><strong><?php echo $patient->post_title;?></strong></a>
        <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id=new'; ?>"> - Nueva consulta</a>

        <?php 
        $related = sw_get_related_appointments($patient->ID); 
        foreach ($related as $r){?>
          <a href="<?php echo esc_url( $appointment_url ).$patient->ID.'&app_id='.$r; ?>"> - Consulta Anterior id: <?php echo $r ?> </a>
          <?php
        }
        ?>
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <?php endforeach; 
  ?>