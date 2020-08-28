<!-- <div id="consultas_paciente" class="wrap" style="margin: 2em 0;"> 
      <h2 class="under font-bold">Consultas Anteriores</h2>
  </div> -->


  <?php
  $appointment_url = home_url().'/consulta/?patient_id=';

  $colpo_url = home_url().'/colposcopia/?patient_id=';
  $colpo_pdf_url = home_url().'/pdf-colpo/?colpo_id=';

  $indicacion_url = home_url().'/indicacion/?patient_id=';
  // $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id='.$post_id;
  $prescription_pdf_url = home_url().'/indicacion-pdf/?indication_id=';


  $estudios_url = home_url().'/estudios/?patient_id=';
  // $studies_pdf_url = home_url().'/estudios-pdf/?studies_id='.$post_id;
  $studies_pdf_url = home_url().'/estudios-pdf/?studies_id=';
  
  $laboratorios_url = home_url().'/laboratorios/?patient_id=';
  // $laboratories_pdf_url = home_url().'/laboratorios-pdf/?laboratories_id='.$post_id;
  $laboratories_pdf_url = home_url().'/laboratorios-pdf/?laboratories_id=';

  $patient_id = $template_args["patient_id"];
  $related = sw_get_related_appointments($patient_id);
  
?>

<div id="Consultas" class="appform tabcontent">
    <div class="card profile-card-action-icons">
      <div class="card-section">
            <div class="profile-card-header" id="consultas-target-div" data-id="<?=$patient_id?>">
                <div class="profile-card-author">





                <div class="row" style="padding: 0 2em;">  
                    <div class="small-12 columns text-center" style="padding-bottom: 0;">
                    <a href="<?php echo esc_url( $appointment_url ).$patient_id.'&app_id=new'; ?>" class="crete-app btn btn-green botones-estandard">Crear nueva consulta</a>
                    </div>
                </div>


                </div>
            </div>

            <div class="profile-card-about">


            <!-- <div id="consultas_paciente" class="wrap" style="margin-bottom: 2em;">  -->
            <div class="wrap" style="margin-bottom: 2em;"> 
                <h2 class="under font-bold">Consultas Anteriores</h2>
            </div>

                <table class="responsive-table">
                <!-- <caption>Todas las pacientes</caption> -->
                <thead>
                    <tr>
                    <th scope="col" class="col-numero">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Consulta</th>
                    <th scope="col">Imágenes</th>
                    <th scope="col">Indicación</th>
                    <th scope="col">Estudios</th>
                    <th scope="col">Laboratorio</th>
                    <th scope="col">Ecografía Venosa</th>
                    </tr>
                </thead>

                <tbody id="tbody-consultas">
                        
                        </tbody>

                </table>

            </div>

        </div>
    </div>
    <div id="profile-card-tabla-consultas">
    </div>

</div>