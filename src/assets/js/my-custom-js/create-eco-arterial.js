var CreateEcoArterialModule = function(){

    //global vars
    var $ = jQuery;
    
    var createEcoArterialBtn;
    var createEcoArterialForm;
    var imagenesEcoArtIzq;
    var imagenesEcoArtDer;
    var loadImagesEco;
    var loadImagesEco_der;
    var fileInput;
    var fileInputDer;
    
    //added 
    // var myInputFile;
    // var myFile;

    function init(){
      $(document).ready(function () {

        createEcoArterialBtn = $("#create-eco-arterial");
        createEcoArterialForm = $("#create-eco-arterial-form");
        loadImagesEco = $("#imagen_eco_arterial");
        loadImagesEco_der = $("#imagen_eco_arterial_der");


        // var fileInput = document.querySelector('input[type="file"]');
        fileInput = document.querySelector('#imagen_eco_arterial');
        fileInputDer = document.querySelector('#imagen_eco_arterial_der');

        imagenesEcoArtIzq = $("#imagenes-eco-art-izq");
        imagenesEcoArtDer = $("#imagenes-eco-art-der");
        // var preview = document.querySelector('.preview');
        

        if (fileInput != null) {
          fileInput.style.opacity = 0;
        }

        if (fileInputDer != null) {
          fileInputDer.style.opacity = 0;
        }

        // dependiendo si se va cargar imagenes en el form izq o derecho llamamos a la funcion que corresponde
        loadImagesEco.on("click", function (e) {
          fileInput.addEventListener('change', updateImageDisplay);
        })

        loadImagesEco_der.on("click", function (e) {
          fileInputDer.addEventListener('change', updateImageDisplayDer);
        })

        createEcoArterialBtn.on("click", function (e) {
          createEcoArterialBtn.fadeOut( "slow" );
          // metemos el div con el spinner hasta que se retonrne del ajax request
          $("#overlay").fadeIn(300);
          saveProfileData(e);
        })


      });
    }//function init


  // POR QUE USO populateFormData() Y FORMDATA:
  // lo ideal y mas sencillo seria tomar los datos del formulario simplemente con serialize(); y no usar populateFormData
  // como lo hacemos en create-patient-js.
  // El PROBLEMA es que de esa forma no se pueden enviar inputs del tipo FILE, los cuales necesitamos para poder agregar imagenes a las colposcopias, por eso nos vemos obligados a usar formData y añadir los demas inputs con el metodo populateFormData()   
  function populateFormData() {
    //var inputs = createAppointmentForm.serializeArray();
    // var inputs = createEcoArterialForm.find("input, select, textarea");
    var inputsIzq = imagenesEcoArtIzq.find("input, select, textarea");
    var inputsDer = imagenesEcoArtDer.find("input, select, textarea");
    var serializedInputs = createEcoArterialForm.serializeArray();
    //no recuerdo por que no logre hacer funcionar con serialize(); por eso uso serializeArray(); 
    //var serializedInputs = createAppointmentForm.serialize();
    var formData = new FormData();


    //console.log("serializedInputs", serializedInputs);


    // tuve que separar la carga de inputs types file en el formdata para que cargue de forma independiente
    // por cada lado, es decir separar lo de lado izq del lado derecho para poder agregarle una palabra clave en el nombre
    // del archivo y luego poder parsear eso en el backend y poder asignar al lado que le corresponde
    $.each(inputsIzq.filter('[type="file"]'), function (i, element) {
        var input = $(element)[0].files;
        $.each(input, function (j, file) {
          formData.append(file.name, file, 'xizqx'+file.name);
        });
    });
    
    $.each(inputsDer.filter('[type="file"]'), function (i, element) {
      var input = $(element)[0].files;
      $.each(input, function (j, file) {
        formData.append(file.name, file, 'xderx'+file.name);
      });
    });

    $.each(serializedInputs, function (i, element) {
      formData.append(element.name, element.value);
    });


    // EL PROBLEMA: 
    // searializArray() funciona correctamente cuando algun valor de los campos del checkbox es seleccionado i.e: al seleccionar el field "inyectable" del checkbox metodoanticopnceptivo genera el array "metodo_anticonceptivo":["preservativos",""] con lo cual se puede guardar los cambios con acf.
    // PERO cuando se desmarca todos los checkboxes fields, serializeArray() simplemente omite enviar ese campo, en vez de generar un array con el nombre de ese campo y valores vacios, es decir, algo asi: "metodo_anticonceptivo":["",""]
    // que es lo que se necesita para que acf pueda guardar los cambios.
    // Solucion: 
    // Este procedimiento se encarga de generar dicho array por cada input del tipo checkbox y lo agrega al formData
    $('#create-eco-arterial-form input[type="checkbox"]:not(:checked)').each(function(i, e) {
        formData.append(e.name, "");
    });

    // formData.append("app_id", "<?php echo $appointment_id ?>");
    // formData.append("patient_id", "<?php echo $patient_id ?>");
    // formData.append("static_data_post_id", "<?php echo $static_data_post_id ?>");
    // formData.append("colpo_post_id", "<?php echo $colpo_post_id ?>");
    // formData.append("action", "sw_create_appointment_ajax");

    return formData;
  }

  function saveProfileData(e) {
    e.preventDefault();

    //alert("Se guardaran los datos");
    var $ = jQuery;
    var formData = populateFormData();

    // console.log("formData = ", formData);
    //Display the key/value pairs
    //  for (var pair of formData.entries())
    //  {
          // console.log(pair[0]+ ', '+ pair[1]); 
    //  }
      // alert("display form data");

    // SI USABAMODS serialize() en vez de serializeArray(), de esta forma debiamos apendar los campos extras
    //var myData = createAppointmentForm.serialize();
    // var myData = createAppointmentForm.serialize() + 
    // '&patient_id=' + '<?php //echo $patient_id?>' + 
    // '&app_id=' + '<?php //echo $appointment_id ?>' + 
    // '&static_data_post_id=' + '<?php //echo $static_data_post_id ?>' + 
    // '&colpo_post_id=' + '<?php //echo $colpo_post_id ?>' + 
    // '&action=' + 'sw_create_appointment_ajax';

    $.ajax({

      type: "POST",
      enctype: 'multipart/form-data',
      url: window.homeUrl + "/wp-admin/admin-ajax.php",
      data: formData,
      //dataType: "json",
      processData: false,
      contentType: false,
      success: function(data){
        var result = JSON.parse(data);
        //console.log("result", result);
        //handle error
        if(result.error.length >0){
        //if(result.error){
          //alert(result.error.msg);
          alert('Error<> Ajax Request: succeded - Backend error: check functions.php -> sw_create_appointment_ajax ');
          //let errorMsg = result.error.msg;
          //jQuery('form#create-appointment-form .errorWrapper').prepend(errorMsg);
        }
        if(result.success){
          //  alert(result['msg']);
          
        //   var oldUrl = window.location.href; 
        //   var replaceId = "app_id="+result['app_id'];
        //   var newUrl = oldUrl.replace("app_id=new", replaceId);
        //   window.location.replace(newUrl);
          
          // window.location.reload();
          setTimeout(function(){
            $("#overlay").fadeOut(300);
          },500);
          window.history.back();

        }
      }
    });
  }

  /*--------------------------------------*/
  // esta funcion carga en el html las imagenes seleccionadas en el lado izquierdo 
  function updateImageDisplay(preview, fileInput) {
    // alert("eco arterial IZQUIERDO  ");
    // fileInput = document.querySelector('input[type="file"]');
    fileInput = document.querySelector('#imagen_eco_arterial');
    preview = document.querySelector('.preview');
    //cuando hay un cambio en input, remover todos los childs de preview
    while(preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    // console.log("fileInput", fileInput.files);
    var curFiles = fileInput.files;
    //si no se agregan o no hay ningun file, apendar a preview un parrafo con texto
    if(curFiles.length === 0) {
      var para = document.createElement('p');
      para.textContent = 'No hay archivos seleccionados';
      preview.appendChild(para);
    } else {
      var list = document.createElement('ol');
      preview.appendChild(list);
      for(var i = 0; i < curFiles.length; i++) {
        //var liContainer = document.createElement('div');
        //liContainer.classList.add("row");
        var listItem = document.createElement('li');
        //liContainer.appendChild(listItem);
        
        //$( listItem ).wrap( "<div class='row'></div>" );
        
        para = document.createElement('p');
        //para.classList.add("small-12");
        //si el tipo es validoy el tamnho no exede los 6MB
        if(validFileType(curFiles[i]) && curFiles[i].size < 6291456) {
          //add a class to change to succes/valid color
          //$(listItem).css('background', '#2c3840');
          
          // var imageName = curFiles[i].name; 
          // curFiles[i].name = 'XXX.png';
          // console.log("name: ", curFiles[i].name);
           para.textContent = 'Nombre del archivo:  ' + curFiles[i].name;
          //var paraText = 'Archivo:  ' + curFiles[i].name + '<br> Tamaño: ' + returnFileSize(curFiles[i].size) + '.';
          //$(para ).html(paraText);

          var image = document.createElement('img');
          
          image.src = window.URL.createObjectURL(curFiles[i]);
          image.alt = "izq";

          var liContainer = document.createElement('div');
          liContainer.classList.add("row");
          //var listItem = document.createElement('li');
          listItem.appendChild(liContainer);

          liContainer.appendChild(image);
          $( image ).wrap( "<div class='small-12 small-centered medium-6 large-6 columns colpo-files-list'></div>" );
          liContainer.appendChild(para);
          $( para ).wrap( "<div class='small-12 small-centered medium-6 large-6 colpo-files-list'></div>" );

        } else {
          //agregar estilo para hacerlo de color rojo
          //$( listItem ).addClass( "listItem-error-color" );
          $(listItem).css('background', '#fc1303');
          para.textContent = 'Nombre del archivo: ' + curFiles[i].name + '  -   Tipo de archivo incorrecto. Actualice las seleccion.';
          listItem.appendChild(para);
        }

        list.appendChild(listItem);
      }
    }
  }

  // esta funcion carga en el html las imagenes seleccionadas en el lado derecho 
  function updateImageDisplayDer(preview, fileInput) {
    // alert("eco arterial DERECHO ");
    // fileInput = document.querySelector('input[type="file"]');
    fileInput = document.querySelector('#imagen_eco_arterial_der');
    preview = document.querySelector('.preview-der');
    //cuando hay un cambio en input, remover todos los childs de preview
    while(preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    // console.log("fileInput", fileInput.files);
    var curFiles = fileInput.files;
    //si no se agregan o no hay ningun file, apendar a preview un parrafo con texto
    if(curFiles.length === 0) {
      var para = document.createElement('p');
      para.textContent = 'No hay archivos seleccionados';
      preview.appendChild(para);
    } else {
      var list = document.createElement('ol');
      preview.appendChild(list);
      for(var i = 0; i < curFiles.length; i++) {
        //var liContainer = document.createElement('div');
        //liContainer.classList.add("row");
        var listItem = document.createElement('li');
        //liContainer.appendChild(listItem);
        
        //$( listItem ).wrap( "<div class='row'></div>" );
        
        para = document.createElement('p');
        //para.classList.add("small-12");
        //si el tipo es validoy el tamnho no exede los 6MB
        if(validFileType(curFiles[i]) && curFiles[i].size < 6291456) {
          //add a class to change to succes/valid color
          //$(listItem).css('background', '#2c3840');
          
           para.textContent = 'Nombre del archivo:  ' + curFiles[i].name;
          //var paraText = 'Archivo:  ' + curFiles[i].name + '<br> Tamaño: ' + returnFileSize(curFiles[i].size) + '.';
          //$(para ).html(paraText);

          var image = document.createElement('img');
          
          image.src = window.URL.createObjectURL(curFiles[i]);
          // image.meta = 'izq'; 
          // image.setAttribute("alt","izq");
          // image.alt = "xxx"
          // curFiles[i].meta = "der";
          console.log("fileInput", fileInput.files);

          var liContainer = document.createElement('div');
          liContainer.classList.add("row");
          //var listItem = document.createElement('li');
          listItem.appendChild(liContainer);

          liContainer.appendChild(image);
          $( image ).wrap( "<div class='small-12 small-centered medium-6 large-6 columns colpo-files-list'></div>" );
          liContainer.appendChild(para);
          $( para ).wrap( "<div class='small-12 small-centered medium-6 large-6 colpo-files-list'></div>" );

        } else {
          //agregar estilo para hacerlo de color rojo
          //$( listItem ).addClass( "listItem-error-color" );
          $(listItem).css('background', '#fc1303');
          para.textContent = 'Nombre del archivo: ' + curFiles[i].name + '  -   Tipo de archivo incorrecto. Actualice las seleccion.';
          listItem.appendChild(para);
        }

        list.appendChild(listItem);
      }
    }
  }


  var fileTypes = [
    'image/jpeg',
    'image/pjpeg',
    'image/png'
  ]

  function validFileType(file) {
    for(var i = 0; i < fileTypes.length; i++) {
      if(file.type === fileTypes[i]) {
        return true;
      }
    }

    return false;
  }



  return{
    init:init
  }

  }();

  CreateEcoArterialModule.init();