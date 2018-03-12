<?php get_header();/* Template Name: About Us */ ?>

<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">One</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>

  <h1>About Us</h1>

  <?php  
    //$post_7 = get_post( 132 );
   // var_dump($post_7);
    //$post_id = $post_7->ID; 
    //$title = $post_7->post_title;
    //echo "Title: ".$title;
    //echo "ID: ".$post_id;

    //$menarca = get_field('menarca', $post_id);
    //echo "Menarca: ".$menarca;
    
    $params = [
      'app_id' => 'new',
      'patient_id' => 37,
      'menarca' => 9999,
      'irs' => 666
    ];

    sw_create_appointment($params);
  ?>

</div>
<?php get_footer(); ?>