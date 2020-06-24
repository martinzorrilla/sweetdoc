var CargarConsultasDiaModule = function(){
    //global vars
    var $ = jQuery;
    var createStudiesBtn;
    // var seleccion; //las opciones son  "cargar_consultas" y "vaciar_consultas"
    var vaciarConsultasBtn;
    

    function init(){
      $(document).ready(function () {
                
        createStudiesBtn = $("#cargar-consultas");
        vaciarConsultasBtn = $("#vaciar-consultas");

        // CARGAR CONSULTAS DESDE EL BACKEND
        createStudiesBtn.on("click", function (e) {
          // createStudiesBtn.fadeOut( "slow" );
            $("#overlay").fadeIn(300);
             saveProfileData(e,"cargar_consultas");         
        })

        // VACIAR CONSULTAS EN EL BACK END
        vaciarConsultasBtn.on("click", function (e) {
            $("#overlay").fadeIn(300);
             saveProfileData(e,"vaciar_consultas");        
        })

      });
    }

    function saveProfileData(e, seleccion) {
      e.preventDefault();
      //alert("Se guardaran los datos");
      var $ = jQuery;
      var myData = 'foo=bar'+ '&action=' + 'sw_cargar_consultas_ajax' + '&seleccion=' + seleccion;
      // var myData = createPatientForm.serialize() + '&patient_id=' + '<?php echo $patient_id ?>';
      // var myData = createStudiesForm.serialize();
      
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
          //  alert(data['msg']);

          if(data.error.length >0){
            if(data.error){
              //alert(data.error.msg);
              alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> cargar consultas ');
              //let errorMsg = result.error.msg;
              //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
            }
          }
          if(data.success){
            // $('#stage').empty();
            $('#consultas-del-dia').empty();
            
            
            console.log(data.msg);
            // aca tenemos la lista de ids de pacientes, con esto hay que iterar pare renderizar los pacientes            
            // $.each( data.msg, function( key, value ) {
            //   // alert( key + ": " + value );
            //   $('#stage').append('<p>Key : ' + key + ' - Value: '+ value + '</p>');
            // });

             $.each( data.msg, function( key, value ) {
               // alert( key + ": " + value );
               $('#consultas-del-dia').append('<div>' + value + '</div>');
             });

            // $('#consultas-del-dia').append('<p>'+data.msg+'</p>');





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