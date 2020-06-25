var tablePatientsModule = function(){
    //global vars
    var $ = jQuery;
    var agregarPacienteConsultaBtn;

    function init(){
      $(document).ready(function () {
                
        agregarPacienteConsultaBtn = $(".agregar-paciente-consulta");

        // CARGAR CONSULTAS DESDE EL BACKEND
        agregarPacienteConsultaBtn.on("click", function (e) {
            // ocultar el boton
            $(this).fadeOut( "slow" );
            // obtener el id que esta en el html de ese elemento
            var data_id = $(this).data('id'); 
            // meter el spinner mientras dure el request
            $("#overlay").fadeIn(300);
            // llamar a la funcion que esta en "create-consultas-del-dia-function.php"
            agregarPacienteConsulta(e, data_id);         
        })

      });
    }

    function agregarPacienteConsulta(e, patient_id) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;
      var myData = 'foo=bar'+ '&action=' + 'sw_cargar_consultas_ajax' + '&patient_id=' + patient_id;
      
      $.ajax({
        type: "POST",
        url:window.homeUrl + "/wp-admin/admin-ajax.php",
        data: myData,
        dataType: "json",
        success: function(data) {

          if(data.error.length >0){
            if(data.error){
              //alert(data.error.msg);
              alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> cargar consultas ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){

            // $('#consultas-del-dia').empty();
            // console.log(data.msg);
            // $.each( data.msg, function( key, value ) {
            //    $('#consultas-del-dia').append('<div>' + value + '</div>');
            //  });

            setTimeout(function(){
              $("#overlay").fadeOut(300);
            },500);

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
  tablePatientsModule.init();