<?php get_header();/**/ ?>

<?php 
  $post_id = get_the_ID(); 
  //echo $post_id;

  $name = get_field('nombre');
  //echo $name;
?>

<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">Onee</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>

  <h1> Ficha del Paciente</h1>

  <div class="row">
    
    <div class="small-12 medium-6 columns"><?php echo $name; ?></div>
    
    <div class="small-12 medium-6 columns">
      <img src="http://via.placeholder.com/150x150" alt="">
    </div>
  </div>

  <h1>Single Person Page Template</h1>

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel esse ut molestiae, nostrum rem doloribusdicta eum, minus voluptatem nam sapiente nesciunt debitis fugiat.</p>

</div>
<?php get_footer(); ?>