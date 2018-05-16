<?php get_header();/* Template Name: About Us */ ?>

  <h1>About Us</h1>

 <!-- Learn about this code on MDN: https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file -->

 <style>

html {
  font-family: sans-serif;
}

.archivos {
  width: 600px;
  background: #ccc;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid black;
}

.archivos ol {
  padding-left: 0;
}

.archivos li, div > p {
  background: #eee;
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  list-style-type: none;
  border: 1px solid black;
}

.archivos img {
  height: 64px;
  order: 1;
}

.archivos p {
  line-height: 32px;
  padding-left: 10px;
}

.archivos label, .archivos button {
  background-color: #7F9CCB;
  padding: 5px 10px;
  border-radius: 5px;
  border: 1px ridge black;
  font-size: 0.8rem;
  height: auto;
}

.archivos label:hover, .archivos button:hover {
  background-color: #2D5BA3;
  color: white;
}

.archivos label:active, .archivos button:active {
  background-color: #0D3F8F;
  color: white;
}

</style>

  <div class="archivos">
    <div>
      <label for="image_uploads">Choose images to upload (PNG, JPG)</label>
      <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
    </div>
    <div class="preview">
      <p>No files currently selected for upload</p>
    </div>
</div>

<?php get_footer(); ?>

<script>
  
var fileInput = document.querySelector('input[type="file"]');
var preview = document.querySelector('.preview');

fileInput.style.opacity = 0;
fileInput.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
  //cuando hay un cambio en input, remover todos los childs de preview
  while(preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

console.log("fileInput", fileInput.files);
  var curFiles = fileInput.files;
  //si no se agregan o no hay ningun file, apendar a preview un parrafo con texto
  if(curFiles.length === 0) {
    var para = document.createElement('p');
    para.textContent = 'No files currently selected for upload';
    preview.appendChild(para);
  } else {
    var list = document.createElement('ol');
    preview.appendChild(list);
    for(var i = 0; i < curFiles.length; i++) {
      var listItem = document.createElement('li');
      var para = document.createElement('p');
      if(validFileType(curFiles[i])) {
        para.textContent = 'File name ' + curFiles[i].name + ', file size ' + returnFileSize(curFiles[i].size) + '.';
        var image = document.createElement('img');
        image.src = window.URL.createObjectURL(curFiles[i]);

        listItem.appendChild(image);
        listItem.appendChild(para);

      } else {
        para.textContent = 'File name ' + curFiles[i].name + ': Not a valid file type. Update your selection.';
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

function returnFileSize(number) {
  if(number < 1024) {
    return number + 'bytes';
  } else if(number >= 1024 && number < 1048576) {
    return (number/1024).toFixed(1) + 'KB';
  } else if(number >= 1048576) {
    return (number/1048576).toFixed(1) + 'MB';
  }
}
  
</script>