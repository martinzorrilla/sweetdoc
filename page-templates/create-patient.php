<?php get_header();/* Template Name: Create Patient*/?>

<?php  
  $all_patient_url = home_url().'/pacientes/';
  $create_patient_url = home_url().'/crear-paciente/';
  $create_secretary_url = home_url().'/crear-asistente/';
?>

<style>
/* body {font-family: Arial;} */

  /* Style the tab */
.tab {
  overflow: hidden;
  /* border: 1px solid #ccc; */
  border: none;
  background-color: #f1f1f1;
}

.tablinks.active{
    border-radius: 10px 10px 0 0;
  }

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 27px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

.tab.white-tab button.active {
  background-color: #fff;
  border-left: 1px solid #ccc;
}

/* Style the tab content */
.tabcontent {
  /* display: none; */
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  background-color: #ccc;
  /* box-shadow: 5px 5px 10px; */
  box-shadow: 0 0 10px;
}

.tabcontent.white-tab{
  border: 1px solid #ccc;
  background-color: #fff;
  border-top: none
}


</style>

<div class="create-patient-div form-tab-style">
<!-- <div class="the-content"> -->

  <h3>Agregar Paciente</h3>

  <!-- agregar la clase white-tab a la clase tab y tabcontent para modificar el color del fichero -->
  <!-- <div class="tab white-tab"> -->
  <div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'London')">Datos Básicos</button>
  </div>

  <!-- <div class="appform tabcontent white-tab"> -->
  <div class="appform tabcontent">
    <form id="create-patient-form" name="create-patient-form" method="post" >
          <fieldset row>
            <div class="floated-label-wrapper large-6 columns">
              <label for="nombre">Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_name" name="patient_name" value="<?php echo $nombre ?>" placeholder="Ingrese el nombre del paciente..." required>
            </div>

            <div class="floated-label-wrapper large-6 columns">
              <label for="apellido">Apellido &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_last_name" name="patient_last_name" value="<?php echo $apellido ?>" placeholder="Ingrese el apellido del paciente..." required>
            </div>

            <div class="floated-label-wrapper large-12 columns">
              <label for="cedula">Cedula &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_ci" name="patient_ci" value="<?php echo $cedula ?>" placeholder="Ingrese el documento del paciente..." required>
            </div>

            <!-- <div class="floated-label-wrapper large-12 columns text-center">
              <button id="create-patient" class="submit_button save-button-expanded" type="submit" value="create-patient">Crear</button>
              <p class="errorWrapper">
              </p>
            </div> -->

            <div class="floated-label-wrapper large-12 columns text-center ">
              <button id="create-patient" class="submit_button save-button-expanded" type="submit" value="create-patient">
              <i class="fas fa-save fa-lg"></i><span class="app-dashboard-sidebar-text"></span>
              </button>
              <p class="errorWrapper">
              </p>
            </div>

          </fieldset>
        </form>
  </div>



<!-- <div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'London')">London</button>
</div>

<div id="London" class="tabcontent">
  <h4>London</h4>
  <p>London is the capital city of England.</p>
</div> -->




</div><!-- create-patient-div -->




<?php get_footer(); ?>

<script >
  var CreatePatientModule = function(){

    //global vars
    var $ = jQuery;

    
    var createPatientBtn;

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