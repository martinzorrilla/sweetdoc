<?php get_header();/* Template Name: Create Secretary*/?>

<?php  
  $all_patient_url = home_url().'/pacientes/';
  $create_patient_url = home_url().'/crear-paciente/';
  $create_secretary_url = home_url().'/crear-asistente/';
?>

<div class="app-dashboard shrink-medium">

  <div class="row expanded app-dashboard-top-nav-bar">
    <div class="columns medium-2">
      <button data-toggle="app-dashboard-sidebar" class="menu-icon hide-for-medium"></button>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="app-dashboard-logo">Inicio</a>
    </div>
    <div class="columns show-for-medium">
      <div class="app-dashboard-search-bar-container">
        <input class="app-dashboard-search" type="search" placeholder="Search">
        <i class="app-dashboard-search-icon fa fa-search"></i>
      </div>
    </div>
    <div class="columns shrink app-dashboard-top-bar-actions">
      <button href="#" class="button hollow">Salir</button>
      <a href="#" height="30" width="30" alt=""><i class="fa fa-info-circle"></i></a>
    </div>
  </div>

  <div class="app-dashboard-body off-canvas-wrapper">
    <div id="app-dashboard-sidebar" class="app-dashboard-sidebar position-left off-canvas off-canvas-absolute reveal-for-medium" data-off-canvas>
      <div class="app-dashboard-sidebar-title-area">
        <div class="app-dashboard-close-sidebar">
          <h3 class="app-dashboard-sidebar-block-title">Menu</h3>
          <!-- Close button -->
          <button id="close-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-sidebar-close-button show-for-medium" aria-label="Close menu" type="button">
            <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-left"></i></a></span>
          </button>
        </div>
        <div class="app-dashboard-open-sidebar">
          <button id="open-sidebar" data-app-dashboard-toggle-shrink class="app-dashboard-open-sidebar-button show-for-medium" aria-label="open menu" type="button">
            <span aria-hidden="true"><a href="#"><i class="large fa fa-angle-double-right"></i></a></span>
          </button>
        </div>
      </div>
      <div class="app-dashboard-sidebar-inner">
        <ul class="menu vertical">
          <li><a href="<?php echo $all_patient_url ?>" class="is-active">
            <i class="fas fa-address-book fa-2x"></i><span class="app-dashboard-sidebar-text"> Listar Pacientes</span>
          </a></li>
          <li><a href="<?php echo $create_patient_url ?>">
            <i class="fas fa-heartbeat fa-lg"></i><span class="app-dashboard-sidebar-text"> Crear Paciente Nuevo</span>
          </a></li>
          <li><a href="<?php echo $create_secretary_url ?>">
            <i class="fas fa-user-md fa-2x"></i><span class="app-dashboard-sidebar-text"> Crear Asistente</span>
          </a></li>
        </ul>
      </div>
    </div>

    <div class="app-dashboard-body-content off-canvas-content" data-off-canvas-content>

        <div class="create-patient-div">

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

                  <button id="create-secretary" class="submit_button save-button-expanded" type="submit" value="create-patient">Guardar</button>
                  <p class="errorWrapper">
                  </p>

                </fieldset>
              </form>
        </div>
      </div><!-- create-patient-div -->

    </div>
  </div>
</div>


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
          createSecretaryBtn.hide();
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