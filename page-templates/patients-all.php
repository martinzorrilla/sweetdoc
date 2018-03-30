<?php get_header();/* Template Name: Patients All */ ?>
<?php//$latest_patients = wp_list_pluck( $latest_patients, 'post_title'  );?>
<?php
//we use this to redirect to an appointment with te selected patient id
//$appointment_url = home_url().'/consulta/?patient_id=';
$create_patient_url = home_url().'/crear-paciente/';
//echo "crear paciente url: ".$create_patient_url;

//$is_secretary = sw_user_has_role_secretary();
//echo "Is secretary? : ";
//wp_die(var_dump($is_secretary));

?>
<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">One</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>


<div class="card-profile-stats">
  <div class="card-profile-stats-intro">
    <img class="card-profile-stats-intro-pic" src="https://pbs.twimg.com/profile_images/732634911761260544/OxHbNdTF.jpg" alt="profile-image" />
    <div class="card-profile-stats-intro-content">
      <h3>Dr. House</h3>
      <p>Gineco obstetra</small></p>
    </div> <!-- /.card-profile-stats-intro-content -->
  </div> <!-- /.card-profile-stats-intro -->

  <hr />

  <div class="card-profile-stats-container">
    <div class="card-profile-stats-statistic">
      <span class="stat">25</span>
      <p>Pacientes</p>
    </div> <!-- /.card-profile-stats-statistic -->
    <div class="card-profile-stats-statistic">
      <span class="stat">12</span>
      <p>Consultas de hoy</p>
    </div> <!-- /.card-profile-stats-statistic -->
    <div class="card-profile-stats-statistic">
      <span class="stat">6</span>
      <p>En espera</p>
    </div> <!-- /.card-profile-stats-statistic -->
  </div> <!-- /.card-profile-stats-container -->

  <div class="card-profile-stats-more">
    <p class="card-profile-stats-more-link"><a href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
    <div class="card-profile-stats-more-content">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem libero fugit, pariatur maxime! Optio enim, deserunt quia molestiae fugiat delectus, dolore et esse nostrum, quod autem necessitatibus fugit soluta repellendus.
      </p>
      <br>
      <div>
        <a href="<?php echo $create_patient_url ?>" rel="nofollow" target="_blank">
            <button id="create-patient" class="submit_button create-patient-button" type="submit" value="Crear">Crear Nuevo Paciente
            </button>
        </a>
      </div>
    </div> <!-- /.card-profile-stats-more-content -->
  </div> <!-- /.card-profile-stats-more -->
</div> <!-- /.card-profile-stats -->


  <div class="profile-card-author">
    <h5 class="author-title">Todos los pacientes</h5>
    <p class="author-description">Alguna descripcion sobre alguna baticosa</p>
  </div>
    

  <!-- 
  Get the Part that renders the Patient List. 
  * search_param = ''; will get all the patients
   -->
  <?php hm_get_template_part('template-parts/patients-all/list-patients', ['search_param' => '']); ?>


</div>
<?php get_footer(); ?>


<script>
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>