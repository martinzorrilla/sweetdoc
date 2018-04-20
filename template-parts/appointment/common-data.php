<?php
    $appointment_post_id = $template_args["appointment_id"]; 
    
    $stored_fields = get_post_custom($appointment_post_id);
    $motivo_de_consulta = $stored_fields['motivo_de_consulta'][0];
    //$irs = $stored_fields['irs'][0];
 ?>
<!-- <h3>Datos de la Consulta</h3> -->
            <div class="card profile-card-action-icons">
              <div class="card-section">
                <div class="profile-card-header">
                  <div class="profile-card-avatar">
                    <img class="avatar-image" src="https://i.imgur.com/3AeQRbR.jpg" alt="Harry Manchanda">
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
                    <label for="menarca">Motivo de Consulta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" id="motivo_de_consulta" name="motivo_de_consulta" value="<?php echo $motivo_de_consulta ?>" placeholder="Type..." required>
                  </div>

                </div>
              </div>
            </div>