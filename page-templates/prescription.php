<?php //acf_form_head(); ?>
<?php get_header();/* Template Name: Prescription*/?>
<?php
  
  $prescription_pdf_url = home_url().'/test';

  //check permissions for the user
  //this page should be visible only for a doctor role. else redirect to home page
  $the_role = sw_get_current_user_role(); // antes usaba esta funcion pero puedo hacer lo mismo con 'current_user_can()'
   if(!current_user_can('doctor') && !current_user_can('administrator')){
     echo "El usuario no es doctor o admin. no puede ver esta pagina";
      //wp_redirect( esc_url( wp_login_url() ), 307);
      //wp_redirect('http://example.com/'); exit;
   }
  
  //The patient id is send from patients-all through the url so we grab here with $_GET
  $patient_id = $_GET['patient_id'];
  $app_id =  $_GET['app_id'];

  //this is to get the id of the static_data post for this patient
  //returns an array 
  $static_data_array = sw_get_static_data_id($patient_id);
  $static_data_post_id = $static_data_array[0];


  //ACF get field IS NOT WORKING for the app posst type when it's just been created so we use geet_post_custom instead to retrieve the data.
  $stored_fields = get_post_custom($app_id);

  if ($app_id === 'new') {
    //echo "  nueva consulta";
    $appointment_id = $app_id;
    $colpo_post_id = 'new';
  }//if new patient = true
  else{
    //echo "no es una nueva consulta";
    $appointment_id = $app_id;
    //get the colposcopia post id for this app
    $colpo_patient_array = sw_get_colpo_id($appointment_id);
    $colpo_post_id = $colpo_patient_array[0];
  }
?>

  <h1 style="text-align: center; margin-left: 50px;">Prescripción</h1>
  <?php hm_get_template_part('template-parts/appointment/patient-data', ['patient_id' => $patient_id]); ?>

  <div class="appform">
    <form id="create-prescription-form" name="create-prescription-form" method="post" class="text-center">

            <?php hm_get_template_part('template-parts/prescription/prescription-data', ['appointment_id' => $appointment_id]); ?>
          
        </form>
  </div>

  <div class="button-div">
    <a href="<?php echo esc_url( $prescription_pdf_url ); ?>">
      <button id="create-prescription" class="save-button-expanded" type="submit" value="Next">Crear Prescripción</button>
    </a>
    
    <p class="errorWrapper"></p>
  </div>


<?php get_footer(); ?>

<script >
  var CreatePrescriptionModule = function(){

    //global vars
    var $ = jQuery;
    var OrgTypeDropdown;
    var rolesDropdown;
    
    var createPrescriptionBtn;
    var createPrescriptionForm;
    
    var createPrescriptionClose;

    //added
    var myInputFile;
    var myFile;

    function init(){
      $(document).ready(function () {

        createPrescriptionBtn = $("#create-prescription");
        createPrescriptionForm = $("#create-prescription-form");
        createPrescriptionClose = $("#create-prescription-close");



        createPrescriptionBtn.on("click", function (e) {
          createPrescriptionBtn.fadeOut( "slow" );
          //saveProfileData(e);
        })


      });
    }


    function populateFormData() {
      //var inputs = createAppointmentForm.serializeArray();
      var inputs = createPrescriptionForm.find("input, select, textarea");
      var serializedInputs = createPrescriptionForm.serializeArray();
      var formData = new FormData();


      console.log("serializedInputs", serializedInputs);

      $.each(serializedInputs, function (i, element) {
        formData.append(element.name, element.value);
      });

      formData.append("app_id", "<?php echo $appointment_id ?>");
      formData.append("patient_id", "<?php echo $patient_id ?>");
      //formData.append("static_data_post_id", "<?php //echo $static_data_post_id ?>");
      //formData.append("colpo_post_id", "<?php //echo $colpo_post_id ?>");

      formData.append("action", "sw_create_prescription_ajax");

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
            var oldUrl = window.location.href; 
            var replaceId = "app_id="+result['app_id'];
            var newUrl = oldUrl.replace("app_id=new", replaceId);
            window.location.replace(newUrl);
            //window.location.reload();
          }
        }
      });
    }


  return{
    init:init
  }

  }();

  CreatePrescriptionModule.init();
</script>