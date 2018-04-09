<?php get_header();/* Template Name: Create Secretary*/?>
<?php?>

<div class="patient-div">

  <ul class="menu align-center">
    <li><a href="#">Onee</a></li>
    <li><a href="#">Two</a></li>
    <li><a href="#">Three</a></li>
  </ul>

  <h1>Crear Nuevo Asistente</h1>

  <div class="appform">
    <form id="create-secretary-form" name="create-patient-form" method="post" class="text-center">
          <fieldset>
            <div class="floated-label-wrapper">
              <label for="nombre">Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_name" name="patient_name" value="<?php echo $nombre ?>" placeholder="Type..." required>
            </div>

            <div class="floated-label-wrapper">
              <label for="apellido">Apellido &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_last_name" name="patient_last_name" value="<?php echo $apellido ?>" placeholder="Type..." required>
            </div>

            <div class="floated-label-wrapper">
              <label for="cedula">Cedula &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="text" id="patient_ci" name="patient_ci" value="<?php echo $cedula ?>" placeholder="Type..." required>
            </div>

            <button id="create-secretary" class="submit_button create-patient" type="submit" value="create-patient">Guardar</button>
            <p class="errorWrapper">
            </p>

          </fieldset>
        </form>
  </div>
</div><!-- patient-div -->
<?php get_footer(); ?>

<script >
  var CreateSecretaryModule = function(){

    //global vars
    var $ = jQuery;
    
    var createSecretaryBtn;

    function init(){
      $(document).ready(function () {
        
        createSecretaryBtn = $("#create-secretary");
        createSecretaryForm = $("#create-secretary-form");

        createSecretaryBtn.on("click", function (e) {
          saveProfileData(e);
        })

      });
    }



    function populateFormData() {
      //var inputs = createAppointmentForm.serializeArray();
      var inputs = createSecretaryForm.find("input, select, textarea");
      var serializedInputs = createSecretaryForm.serializeArray();
      var formData = new FormData();


      console.log("serializedInputs", serializedInputs);


      $.each(serializedInputs, function (i, element) {
        formData.append(element.name, element.value);
      });

      //formData.append("app_id", "<?php //echo $appointment_id ?>");
      //formData.append("patient_id", "<?php //echo $patient_id ?>");
      //formData.append("app_id", "55");

      formData.append("action", "sw_create_secretary_ajax");

      return formData;
    }

    function saveProfileData(e) {
      e.preventDefault();

      alert("Se guardaran los datos");
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
            alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_secretary_ajax ');
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

  CreateSecretaryModule.init();
</script>