var CreatePatientModule = function(){

    //global vars
    var $ = jQuery;

    var createPatientBtn;
    // var editPatientBtn;
    var deletePatientBtn;

    var createPatientForm;
    var deletePatientForm;


    function init(){
      $(document).ready(function () {
        //dom queries

        //createProfileClose = $("#create-profile-close");

        createPatientBtn = $("#create-patient");
        deletePatientBtn = $("#delete-patient");
        // editPatientBtn = $("#toggle-input");

        createPatientForm = $("#create-patient-form");
        deletePatientForm = $("#delete-patient-form");

        createPatientBtn.on("click", function (e) {
          //createPatientBtn.fadeOut( "slow" );
          //  alert("Se creara un paciente nuevo");
          $("#overlay").fadeIn(300);
          saveProfileData(e);
        })

        deletePatientBtn.on("click", function (e) {
          // deletePatientBtn.fadeOut( "slow" );

          // ESTA NO ES LA MEJOR FORMA DE VALIDAR YA QUE NO PUEDO OCULTAR EL PASS.
          // DEBERIA CREAR UN FORM HTML CON UN INPUT PASS Y ESO ENVIAR AL POPUP.
          var pass = prompt("Se eliminara la paciente y todos los datos como consultas, colposcopias etc.", "Ingrese el código");
          if (pass != null && pass != "") {
            if(pass === "0009"){
              $("#overlay").fadeIn(300);
              deletePatientData(e);
            }
            else {
             alert("Código incorrecto. Operación Cancelada.");
            }
          } 

          // ESTO TAMBIEN FUNCIONA PERO SOLO PIDE CONFIRMACION PARA BORRAR EL PACIENTE
          // if(confirm("Se eliminara la paciente y todos los datos como consultas, colposcopias etc.")) {
          //   this.click;
          //     //  alert("Paciente eliminado");
          //     $("#overlay").fadeIn(300);
          //      deletePatientData(e);
          //  }
          //  else
          //  {
          //      //alert("Cancel");
          //  }

        })

        // editPatientBtn.on("click", function (e) {
        //   // createPatientBtn.fadeOut( "slow" );
        //   toggleDisableInput(e);
        // })

      });
    }

    function saveProfileData(e) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;
      //var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      var myData = createPatientForm.serialize();

      $.ajax({
        type: "POST",
        url:window.homeUrl + "/wp-admin/admin-ajax.php",
        data: myData,
        dataType: "json",
        success: function(data) {
          //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
          // do what ever you want with the server response
          //var result = $.parseJSON(data); esto es viejo, de la parte que hacia mal creo

          // console.log("data response", data);
          // alert(data['msg']);
          // window.location.reload();

          if(data.error.length >0){
            if(data.error){
              console.log(data);
              //alert(data.error.msg);
              alert(data['msg']);
              setTimeout(function(){
                $("#overlay").fadeOut(300);
              },500);
              //alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){
             alert('Paciente creada/editada: '+data['msg']);
            //var singlePatient = toString(data['msg']);
            //alert(singlePatient);
            //$('#interests').foundation('open');
            //var oldUrl = window.location.href;
            //var replaceId = "app_id="+result['app_id'];
            //var newUrl = oldUrl.replace("app_id=new", replaceId);
            //window.location.replace(newUrl);
            // window.location.replace(window.location.hostname);
            // window.location.reload();
            setTimeout(function(){
              $("#overlay").fadeOut(300);
            },500);
            // alert(window.location);
            // esto se usa en desarrollo en localhost
            // window.location.replace('/sweetdoc/sw_patient/'+data['msg']);

            // esto se usa en produccion en el live-server
            window.location.replace('/sw_patient/'+data['msg']);
            //var myPatientUrl = '/sweetdoc/sw_patient/'+singlePatient;
            //window.location.replace(myPatientUrl);

          //  console.log(window.location.hostname);
          //  alert(window.location.hostname);

          }
        },
        error: function() {
            alert('error handling here');
        }
      });// $.ajax
    }

    function deletePatientData(e) {
      e.preventDefault();
      //alert("se borrara el paciente y todos sus datos?");
      var $ = jQuery;
      var myData = deletePatientForm.serialize();
      //var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      // var deleteData =  {patient_id : '<?php echo $patient_id ?>', action : 'sw_delete_patient_ajax'};
      // var deleteData =  {'patient_id' : '800', 'action' : 'sw_delete_patient_ajax'};



      $.ajax({
        type: "POST",
        url:window.homeUrl + "/wp-admin/admin-ajax.php",
        data: myData,
        // data : {action: "sw_delete_patient_ajax", patient_id : 980},
        dataType: "json",
        success: function(data) {
          //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
          // do what ever you want with the server response
          //var result = $.parseJSON(data); esto es viejo, de la parte que hacia mal creo

          // console.log("data response", data);
          // alert(data['msg']);
          // window.location.reload();
          //alert('11');

          if(data.error.length >0){
            if(data.error){
              //alert(data.error.msg);
              alert('Error<> Ajax Request: succeded - Backend error: check patient-functions.php -> sw_delete_appointment_ajax ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){
            //  alert('entro aca');
            //console.log(window.location.hostname);
            // console.log(data['msg']);

            //alert('data.success');
            //$('#interests').foundation('open');
            //var oldUrl = window.location.href;
            //var replaceId = "app_id="+result['app_id'];
            //var newUrl = oldUrl.replace("app_id=new", replaceId);
            //window.location.replace(newUrl);

            //window.location.replace(newUrl);

            // window.location();

            window.location.replace('/sweetdoc/pacientes/');
            // window.location.replace('/sweetdoc/sw_patient/'.data['msg']);

            // GoToHomePage();
            // window.location.reload();

            // alert(window.location.hostname);
          }
        },
        error: function() {
            alert('error handling the patient delete');
        }
      });// $.ajax

    }

    // function to enable and disable the edit on the create patient form. we get all the inputs in the form, all of them should
    // have the class "disableable-input" so we can target only those inputs. then we can toggle the "disabled" property.

    // function toggleDisableInput(e){
    //   e.preventDefault();

    //   var allInputs = createPatientForm.find(":input" );
    //   //alert("Found:  " + allInputs.length);
    //   allInputs.each(function(el) {
    //     //console.log($(this));
    //     if ($(this).hasClass( "disableable-input" )) {
    //       if ( $( this ).is( ":disabled" ) ){
    //         $(this).prop("disabled", false);
    //       }else{
    //         $(this).prop("disabled", true);
    //       }
    //     }
    //   });
    // }

  return{
    init:init
  }

  }();
  CreatePatientModule.init();