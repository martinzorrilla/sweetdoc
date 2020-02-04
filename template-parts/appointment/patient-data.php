<?php
  $patient_id = $template_args["patient_id"];
  //load all the data we need from the Patient Post
  $patient_fields = get_post_custom($patient_id);
  $name = $patient_fields['nombre'][0];
  $lastname = $patient_fields['apellido'][0];
  $cedula = $patient_fields['cedula'][0];
  $fullname = $name.' '.$lastname;
  $fecha_de_nacimiento = $patient_fields['fecha_de_nacimiento'][0] !="" && $patient_fields['fecha_de_nacimiento'][0] !=NULL ? $patient_fields['fecha_de_nacimiento'][0] : "";
  
  //$bday = new DateTime('23.8.1988'); // Your date of birth
  $bday = new Datetime(date('d.m.y'));
  if ($fecha_de_nacimiento != ""){ $bday = new Datetime(date('d.m.y', strtotime($fecha_de_nacimiento)));}
  $today = new Datetime(date('d.m.y'));
  $diff = $today->diff($bday);
  //printf(' Edad : %d años, %d meses, %d dias', $diff->y, $diff->m, $diff->d);
  

 ?> 

  <div class="card profile-card-action-icons">
    <div class="card-section">
      <div class="profile-card-header">
        <div class="profile-card-author">
          <h5 class="author-title"><?php echo $fullname ?></h5>
        </div>
      </div>
      <div class="profile-card-about">
        <h5 class="about-title separator-left">Acerca de <?php echo $name?></h5>
        <p class="about-content">
          <p><?php echo("Cedula : ".$cedula);?></p>
          <p><?php printf(' Edad : %d años, %d meses, %d dias', $diff->y, $diff->m, $diff->d); ?></p>
        </p>

        <br>
        <h5 class="about-title separator-left">Ultimo estudios</h5>
        
        <div class="row about-skills">
          <div class="small-6 columns">
            <ul class="arrow">
              <li>Ecografia</li>
              <li>Colposcopia</li>
              <li>Analisis de Sangre</li>
            </ul>
          </div>
          <div class="small-6 columns">
            <ul class="arrow">
              <li>Ecografia</li>
              <li>Leep</li>
              <li>Colposcopia</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>