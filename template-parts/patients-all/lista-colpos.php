
<div id="consultas_paciente" data-closable class="callout alert-callout-border primary text-center" style="margin-top: 2rem;">
    <h3 style="font-weight: bold;">Colposcopías</h3>
</div>
  <?php
    $appointment_url = home_url().'/consulta/?patient_id=';
    $indicacion_url = home_url().'/indicacion/?patient_id=';
    $estudios_url = home_url().'/estudios/?patient_id=';
    $patient_id = $template_args["patient_id"];

     $patients_colpos = sw_patiente_colpos($patient_id);
    //var_dump($patients_colpos);
     foreach ($patients_colpos as $p){
      //$colpo_post =get_post($p);
       $creation_date = get_the_date( 'd-M-Y', $p );?>
         <div data-closable class="callout alert-callout-border secondary">
            <a href="<?php echo get_permalink( $p ); ?> "> - Colposcopia en fecha <strong> <?php echo $creation_date ?> </strong> - iD: <?php echo $p ?></a>
        </div>
    <?php 
     } //foreach patient_colpos ?>