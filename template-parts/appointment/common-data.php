<?php
    $appointment_post_id = $template_args["appointment_id"]; 
    
    $stored_fields = get_post_custom($appointment_post_id);
    $motivo_de_consulta = $stored_fields['motivo_de_consulta'][0];
    $antecedente_actual = $stored_fields['antecedente_actual'][0];
    //$irs = $stored_fields['irs'][0];
    //get the values that  are selected on the checkbox
    $checkbox = get_field('checkbox', $appointment_post_id);
    

    //$checkbox_options = $stored_fields['checkbox'];
    //$checkbox_options = get_post_meta($appointment_post_id,'checkbox');
    //var_dump($checkbox_options);

    //get all the posible values for the  checkbox
    $field_key = "select";
    $field = get_field_object($field_key, $appointment_post_id);

    //var_dump($field);

    $checkbox_field_key = "checkbox";
    $checkbox_field = get_field_object($checkbox_field_key, $appointment_post_id);

 ?>
<!-- <h3>Datos de la Consulta</h3> -->
            <div class="card profile-card-action-icons">
              <div class="card-section">
                <div class="profile-card-header">
                  <div class="profile-card-avatar">
                    <img class="avatar-image" src="<?php bloginfo('template_url')?>/src/assets/images/pepaicon.jpg" alt="Peppa Pig">
                  </div>
                  <div class="profile-card-author">
                    <h5 class="author-title">Motivo de Consulta</h5>
                    <p class="author-description">Paciente</p>
                  </div>
                </div>
                <div class="profile-card-about">
                  <h5 class="about-title separator-left">Aca van los campos <?php //echo $name?></h5>
                  <p class="about-content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem eveniet nulla quae ullam sit iure voluptatum, nesciunt voluptas perferendis, minus natus in quaerat?
                  </p>

                  <div class="floated-label-wrapper">
                    <label for="Motivo de Consulta">Motivo de Consulta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="motivo_de_consulta" name="motivo_de_consulta" value="<?php echo $motivo_de_consulta ?>" placeholder="Escribir..." required>
                  </div>

                  <div class="floated-label-wrapper">
                    <label for="antecedente_actual">Antecedentes de la enfermedad actual &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="antecedente_actual" name="antecedente_actual" value="<?php echo $antecedente_actual ?>" placeholder="Escribir..." required>
                  </div>                  

                </div>
              </div>
            </div>