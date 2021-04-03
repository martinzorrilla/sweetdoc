<?php

global $EM_Event;
$event_id = $EM_Event->post_id;
//  var_dump($EM_Event);

?>

<!-- <h3>Paciente: < ?php echo $EM_Event->event_name; ?> </h3> -->
<!-- <h3>ID: < ?php echo $EM_Event->post_id; ?> </h3> -->
<div class="em-event-single mz-hide-edit-meta-data">
    <?php

    echo do_shortcode('[event post_id="'.$EM_Event->post_id.'"]<h2 class="under font-bold"> #_EVENTNAME </h2>[/event]');
    echo '<br/><strong>Fecha/Hora</strong><br/>';
    echo do_shortcode('[event post_id="'.$EM_Event->post_id.'"]#_EVENTDATES[/event]');

    echo '<br/>';
    echo do_shortcode('[event post_id="'.$EM_Event->post_id.'"]<i>#_EVENTTIMES</i>[/event]');
    
    echo '<div class="event-observaciones single-event-block-separator">';
    echo '<strong>Observaciones</strong>';
    echo do_shortcode('[event post_id="'.$EM_Event->post_id.'"]#_EVENTNOTES[/event]');
    echo '</div>';
    
    
    echo '<div class="event-categories single-event-block-separator">';
    echo '<strong>Categorias</strong>';
    echo '<br/>';
    echo do_shortcode('[event post_id="'.$EM_Event->post_id.'"]#_CATEGORIES[/event]');
    echo '</div>';


    ?>

    <a href="<?php echo $EM_Event->get_edit_url(); ?>">Editar Reserva</a>
</div>