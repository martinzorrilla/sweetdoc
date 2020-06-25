var CargarConsultasDiaModule = function(){
    //global vars
    var $ = jQuery;
    var cargarConsultasBtn;
    var vaciarConsultasBtn;

    var nulData = "";

    function init(){
      $(document).ready(function () {
                
        cargarConsultasBtn = $("#cargar-consultas");
        vaciarConsultasBtn = $("#vaciar-consultas");
        // eliminarPacienteBtn = $("#eliminar-paciente-del-dia");
        
        // esto lo que hace es cargar la lista de pacientes del dia automaticamente sin presionar ningun boton
        saveProfileData(null,"cargar_consultas", nulData, nulData);         
        // alert("ya se cargo toda la pagina");

        // CARGAR CONSULTAS DESDE EL BACKEND
        cargarConsultasBtn.on("click", function (e) {
          // cargarConsultasBtn.fadeOut( "slow" );
            $("#overlay").fadeIn(300);
             saveProfileData(e,"cargar_consultas", nulData, nulData);         
        })

        // VACIAR CONSULTAS EN EL BACK END
        vaciarConsultasBtn.on("click", function (e) {
            $("#overlay").fadeIn(300);
             saveProfileData(e,"vaciar_consultas", nulData, nulData);        
        })

        // Eliminar paciente de la lista. XQ USE document.on? xq solo de esta forma se puede capturar un evento de un elemento que se creo dinamicamente
        // como es el caso de la clase eliminar-paciente-del-dia. esta se crea recien cuando se hace el request de listado de pacientes
        $(document).on('click','.eliminar-paciente-del-dia',function(){
          var data_id = $(this).data('id'); 
          // alert("eliminar de la lista "+ data_id);
          $("#overlay").fadeIn(300);
          saveProfileData(null, nulData, data_id, true);         
        
        });

      });
    }

    function saveProfileData(e, seleccion, patient_id, eliminar_paciente) {
            
      // e.preventDefault();
      //alert("Se guardaran los datos"); eliminar_paciente
      var $ = jQuery;
      var myData = 'foo=bar'+ '&action=' + 'sw_cargar_consultas_ajax' + '&seleccion=' + seleccion + '&patient_id=' + patient_id + '&eliminar_paciente=' + eliminar_paciente;
      // var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      // var myData = createStudiesForm.serialize();
      
      $.ajax({
        type: "POST",
        url:window.homeUrl + "/wp-admin/admin-ajax.php",
        data: myData,
        dataType: "json",
        success: function(data) {

          if(data.error.length >0){
            if(data.error){
              alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> cargar consultas ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){
            
            var accionInicial = data.accion_inicial;
            
            // console.log(data.msg);
            // console.log(accionInicial);

            if (accionInicial != "eliminar_paciente") {
              $('#consultas-del-dia').empty();
            }            
            
             $.each( data.msg, function( key, value ) {
               // alert( key + ": " + value );
              //  $('#consultas-del-dia').append('<div>' + value + '</div>');
               $('#consultas-del-dia').append(value);
             });

            setTimeout(function(){
              $("#overlay").fadeOut(300);
            },500);
            // window.history.back();
            // window.location.reload();

          }
        },
        error: function() {
            alert('No se pudo cargar las consultas del dia');
        }
      });// $.ajax
    }

  return{
    init:init
  }

  }();
  CargarConsultasDiaModule.init();