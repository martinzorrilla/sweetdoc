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
    
/*    $params = [
      'app_id' => 168,
      'menarca' => 89,
      'irs' => 89
    ];

    echo "post: ".$params['app_id']." fields<br>";
    $stored_fields = get_post_custom($params['app_id']);
    var_dump($stored_fields);
    //var_dump(get_fields($params['app_id']));
    echo "<br>";
    echo "<br>";
    echo "<br>";

    sw_update_single_appointment($params);*/



    /*To create a new TEST appointment for the patient 37*/

    /*    $params = [
          'app_id' => 'new',
          'patient_id' => 37,
          'menarca' => 444,
          'irs' => 555
        ];
        sw_create_new_appointment($params);
    */


    /*To create a new TEST Patient*/

    $params = [
      'patient_name' => 'yyy-',
      'patient_ci' => '123'
    ];
    $result = sw_create_patient($params);
    var_dump("result = ".$result['success']);

  ?>

</div>
<?php get_footer(); ?>