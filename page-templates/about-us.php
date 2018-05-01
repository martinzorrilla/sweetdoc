<?php get_header();/* Template Name: About Us */ ?>

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

 /*       $params = [
          'app_id' => 'new',
          'patient_id' => 213,
          'menarca' => 444,
          'irs' => 555
        ];
        sw_create_new_appointment($params);
    */


    /*To create a new TEST Patient*/

/*    $params = [
      'patient_name' => 'yyy-',
      'patient_ci' => '123'
    ];
    $result = sw_create_patient($params);
    var_dump("result = ".$result['success']);
*/


        /*To create a new TEST secretrary*/

/*    $params = [
      'patient_name' => 'backend',
      'patient_last_name' => '123',
      'patient_ci' => 'back@bk.com'
    ];
    $result = sw_create_secretary($params);
    var_dump("result = ".$result['msg']);
*/

        /*To create a new TEST secretrary*/

 /*   $params = [
      'patient_name' => 'Private',
      'patient_last_name' => 'Data',
      'patient_id' => 263
    ];
    //$result = sw_create_static_data($params);
    var_dump("result = ".$result['msg']);*/

  ?>

<!-- 
permite touch y mouse
https://codepen.io/michaelsboost/pen/cnCAL

codigo de abajo
http://www.tutorialized.com/tutorial/Draw-on-a-HTML5-Canvas-with-the-Mouse/79247
 -->

<div align="center">
        <canvas id="myCanvas" width="500" height="200" style="border:2px solid black"></canvas>
        <br /><br />
        <button onclick="javascript:clearArea();return false;">Clear Area</button>
        Line width : <select id="selWidth">
            <option value="1">1</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="7">7</option>
            <option value="9" selected="selected">9</option>
            <option value="11">11</option>
        </select>
        Color : <select id="selColor">
            <option value="black">black</option>
            <option value="blue" selected="selected">blue</option>
            <option value="red">red</option>
            <option value="green">green</option>
            <option value="yellow">yellow</option>
            <option value="gray">gray</option>
        </select>
    </div>



<?php get_footer(); ?>

<script>
 window.onload = function() {
  var mousePressed = false;
var lastX, lastY;
var ctx;

InitThis();

function InitThis() {
    ctx = document.getElementById('myCanvas').getContext("2d");

    $('#myCanvas').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#myCanvas').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#myCanvas').mouseup(function (e) {
        mousePressed = false;
    });
      $('#myCanvas').mouseleave(function (e) {
        mousePressed = false;
    });
}

function Draw(x, y, isDown) {
    if (isDown) {
        ctx.beginPath();
        ctx.strokeStyle = $('#selColor').val();
        ctx.lineWidth = $('#selWidth').val();
        ctx.lineJoin = "round";
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.closePath();
        ctx.stroke();
    }
    lastX = x; lastY = y;
}
  
function clearArea() {
    // Use the identity matrix while clearing the canvas
    ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}
};
</script>