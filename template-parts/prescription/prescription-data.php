<?php
    $appointment_post_id = $template_args["appointment_id"]; 
    echo "string ".$appointment_post_id ;
    $stored_fields = get_post_custom($appointment_post_id);
    
    //$motivo_de_consulta = $stored_fields['motivo_de_consulta'][0];
    //$antecedente_actual = $stored_fields['antecedente_actual'][0];
    //$irs = $stored_fields['irs'][0];
 ?>
<!-- <h3>Datos de la Consulta</h3> -->
            <div class="card profile-card-action-icons">
              <div class="card-section">
                <div class="profile-card-header">
                  <div class="profile-card-avatar">
                    <img class="avatar-image" src="<?php bloginfo('template_url')?>/src/assets/images/pepaicon.jpg" alt="Peppa Pig">
                  </div>
                  <div class="profile-card-author">
                    <h5 class="author-title">Indicaciones</h5>
                    <p class="author-description">Paciente</p>
                  </div>
                </div>
                <div class="profile-card-about">
                  <h5 class="about-title separator-left">Ingrese los Datos <?php //echo $name?></h5>
                  <!-- <p class="about-content">
                    Ingrese los Datos
                  </p> -->

                  <div class="floated-label-wrapper">
                    <label for="Motivo de Consulta">Indicaciones &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="motivo_de_consulta" name="motivo_de_consulta" value="<?php echo $motivo_de_consulta ?>" placeholder="Escribir..." required>
                  </div>

                  <div class="floated-label-wrapper">
                    <label for="antecedente_actual">Medicamentos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="antecedente_actual" name="antecedente_actual" value="<?php echo $antecedente_actual ?>" placeholder="Escribir..." required>
                  </div>

                </div>
              </div>
            </div>