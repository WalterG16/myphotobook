import Dropzone from "dropzone";
import { error } from "laravel-mix/src/Log";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Subi aca la IMAGEN',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivos',
    maxFiles: 1,
    uploadMultiple: false,

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){ 
            const imagenPublicada = {}
            imagenPublicada.size =1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/${imagenPublicada}')

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }

});

dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen
});

dropzone.on("removedfile", function(){
    console.log("Archivo eliminado");
    document.querySelector('[name="imagen"]').value = "";
});
