import { Callbacks } from "jquery";
import Vue from "vue";

Vue.mixin({
    methods: {
        confirm: function(Callbacks){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) Callbacks();
              });
        },


        loadThumbnail: function(e){
      
              let file = e.target.files[0];
              let reader = new FileReader();
            
              if (file.type === 'image/jpeg') {
                reader.onload  = e => {
                  this.form.thumbnail = e.target.result;
                }

                reader.readAsDataURL(file);

              } else {
                toastr.error('Image formet not supported!', 'Error');
              }
         
            },

        imageLink: function(name){
          if (name != '' && name.length < 256) {
            return 'upload/posts/' + name; 
          }else{
            return this.form.thumbnail;
          }
          
        },

    }
});
