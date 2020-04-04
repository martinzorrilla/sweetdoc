<?php get_header();/* Template Name: file-tab-test*/?>


<div class="create-patient-div form-tab-style">
<!-- <div class="the-content"> -->


    <?php hm_get_template_part('template-parts/appointment/motivo-consulta', ['appointment_id' => $appointment_id]); ?>



<!-- <div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'London')">London</button>
</div>

<div id="London" class="tabcontent">
  <h4>London</h4>
  <p>London is the capital city of England.</p>
</div> -->




</div><!-- create-patient-div -->

<div class="buscar-ci" id="buscar-ci">
  <div class="input-group">
    <span class="input-group-label">Cedula: </span>
    <input class="input-group-field" type="number">
    <div class="input-group-button">
      <input type="submit" class="button" value="Buscar">
    </div>
  </div>
</div>

<?php 

// args
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'sw_patient',
	'meta_key'		=> 'cedula',
	'meta_value'	=> '334455'
);


// query
$the_query = new WP_Query( $args );

?>
<?php if( $the_query->have_posts() ): ?>
	<ul>
	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php the_field('event_thumbnail'); ?>" />
				<?php the_title(); ?>
			</a>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>




<?php get_footer(); ?>

<script >
  var CreatePatientModule = function(){

    //global vars
    var $ = jQuery;

    
    var createPatientBtn;

    var buscarCiBtn;

/*    var createAppointmentForm;
    var createProfileClose;
    //added
    var myInputFile;
    var myFile;*/

    function init(){
      $(document).ready(function () {
        //dom queries 
        //OrgTypeDropdown = $('.org-type-dropdown select');
        //rolesDropdown = $('.role-type-dropdown select');
        //createProfileClose = $("#create-profile-close");
        
        createPatientBtn = $("#create-patient");
        createPatientForm = $("#create-patient-form");
        buscarPorCiBtn = $("#buscar-ci");

        createPatientBtn.on("click", function (e) {
          createPatientBtn.fadeOut( "slow" );
          saveProfileData(e);
        })

      });
    }



    function populateFormData() {
      //var inputs = createAppointmentForm.serializeArray();
      var inputs = createPatientForm.find("input, select, textarea");
      var serializedInputs = createPatientForm.serializeArray();
      var formData = new FormData();


      //console.log("serializedInputs", serializedInputs);


      $.each(serializedInputs, function (i, element) {
        formData.append(element.name, element.value);
      });

      //formData.append("app_id", "<?php //echo $appointment_id ?>");
      //formData.append("patient_id", "<?php //echo $patient_id ?>");
      //formData.append("app_id", "55");

      formData.append("action", "sw_create_patient_ajax");

      return formData;
    }

    function saveProfileData(e) {
      e.preventDefault();

      //alert("Se guardaran los datos");
      var $ = jQuery;
      var formData = populateFormData();

      //console.log("formData = ", formData);
      // Display the key/value pairs
      for (var pair of formData.entries())
      {
       console.log(pair[0]+ ', '+ pair[1]); 
      }

      $.ajax({
        url: window.homeUrl + "/wp-admin/admin-ajax.php",
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data){
          var result = JSON.parse(data);
          console.log("result", result);
          //handle error
          if(result.error.length >0){
          //if(result.error){
            //alert(result.error.msg);
            alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
            //let errorMsg = result.error.msg;
            //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
          }
          if(result.success){
            alert(result['msg']);
            //$('#interests').foundation('open');
            //var oldUrl = window.location.href; 
            //var replaceId = "app_id="+result['app_id'];
            //var newUrl = oldUrl.replace("app_id=new", replaceId);
            //window.location.replace(newUrl);
            window.location.reload();
          }
        }
      });
    }


  return{
    init:init
  }

  }();

  CreatePatientModule.init();
</script>