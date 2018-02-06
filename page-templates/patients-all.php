<?php get_header();/* Template Name: Patients All */ ?>
<?php  //$latest_patients = wp_list_pluck( $latest_patients, 'post_title'  );?>

<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">One</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>

  <h1>Todos los Pacientes</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel esse ut molestiae</p>    

  <?php 
  $args = array(
    'numberposts' => -1,
    'post_type'   => 'sw_patient'
  );
  $latest_patients = get_posts( $args );?>

<?//php var_dump($latest_patients) ?>

  <div class="row">
    <?php foreach ($latest_patients as $patient): ?>
      <div class="small-12 medium-6 large-6 columns patient-row">
        <a href="<?php get_permalink($patient->ID);?>"> <?php echo $patient->post_title;?></a>
      </div>
    <?php endforeach; ?>
  </div>



<div class="card-profile-stats">
  <div class="card-profile-stats-intro">
    <img class="card-profile-stats-intro-pic" src="https://pbs.twimg.com/profile_images/732634911761260544/OxHbNdTF.jpg" alt="profile-image" />
    <div class="card-profile-stats-intro-content">
      <h3>Joe Smith</h3>
      <p>Joined Jan.16th 2017</small></p>
    </div> <!-- /.card-profile-stats-intro-content -->
  </div> <!-- /.card-profile-stats-intro -->

  <hr />

  <div class="card-profile-stats-container">
    <div class="card-profile-stats-statistic">
      <span class="stat">25</span>
      <p>posts</p>
    </div> <!-- /.card-profile-stats-statistic -->
    <div class="card-profile-stats-statistic">
      <span class="stat">125</span>
      <p>followers</p>
    </div> <!-- /.card-profile-stats-statistic -->
    <div class="card-profile-stats-statistic">
      <span class="stat">88</span>
      <p>likes</p>
    </div> <!-- /.card-profile-stats-statistic -->
  </div> <!-- /.card-profile-stats-container -->

  <div class="card-profile-stats-more">
    <p class="card-profile-stats-more-link"><a href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a></p>
    <div class="card-profile-stats-more-content">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem libero fugit, pariatur maxime! Optio enim, deserunt quia molestiae fugiat delectus, dolore et esse nostrum, quod autem necessitatibus fugit soluta repellendus.
      </p>
    </div> <!-- /.card-profile-stats-more-content -->
  </div> <!-- /.card-profile-stats-more -->
</div> <!-- /.card-profile-stats -->



<div data-closable class="callout alert-callout-border primary">
  <strong>Whoops!</strong> - You clearly did that wrong.
  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    <span aria-hidden="true">&times;</span>
  </button>
</div>


</div>
<?php get_footer(); ?>