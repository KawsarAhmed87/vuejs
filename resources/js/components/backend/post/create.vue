<template>
   <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create a new post</h3>

          <div class="card-tools">
            <router-link to="/post" class="btn btn-block btn-success btn-sm">Post list</router-link>
          </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" @submit.prevent="submitForm" @keydown="form.onKeydown($event)" enctype="multipart/form-data"> 
                <div class="card-body">

                  
                  <div class="form-group row">
                    <label for="categoryId" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="categoryId" v-model="form.category_id"> 
                        <option value="">Select</option>
                        <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                      </select>
                      <HasError :form="form" field="category_id" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="postTitle" class="col-sm-2 col-form-label">Ttile</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="postTitle" placeholder="Post title" v-model="form.title" >
                      <HasError :form="form" field="title" />
                    </div>
                  </div> 
                   

                   <div class="form-group row">
                    <label for="postContent" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                      
                      <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                      <HasError :form="form" field="content" />
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label for="postThumbnail" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file"  id="postThumbnail" @change="loadThumbnail($event)"/>
                      <img :src="form.thumbnail" alt="">
                      <HasError :form="form" field="thumbnail" />
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="activeCheck" value="published" v-model="form.status">
                        <label class="form-check-label" for="activeCheck">Published</label>
                        
                        </div>
                         <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inActiveCheck" value="draft" v-model="form.status">
                        <label class="form-check-label" for="inActiveCheck">Draft</label>
                        </div>
                        <HasError :form="form" field="status" />
                    </div>
                  </div>
              
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" :disabled="form.busy">Submit</button>
                  <button type="reset" class="btn btn-secondary float-right">Reset</button>
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
        <!-- /.card-body -->
         <div class="card-footer clearfix">
               
              </div>
        <!-- /.card-footer-->
      </div>

      

    </section>
    <!-- /.content -->
  </div>
</template>

<script>

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {

    name: "create",
    data: () => ({
    form: new Form({
      title: null,
      category_id: '',
      content: null,
      thumbnail: null,
     
      status: 'published', 
    }),

     editor: ClassicEditor,
      editorConfig: {
          // The configuration of the editor.
      }
  }),

  mounted() {
    this.$store.dispatch("getActiveCategories");
  },

   computed:{
    categories(){
      return this.$store.getters.categories;
    }
  },

  methods: {
    async submitForm () {
    let alterThis = this;
      const response = await this.form.post('/post-create')
        .then(function(response){
                   
          /*toastr---------*/
         toastr.success('Data saved successfully!', 'Success');
        })
        
        /*go to another page*/

        alterThis.$router.push("/post");
    },

    loadThumbnail: function(e){
      
      let file = e.target.files[0];
      let reader = new FileReader();
    
      reader.onload  = e => {
        this.form.thumbnail = e.target.result;
      }

      reader.readAsDataURL(file);
    }

  }

}
</script>

<style>

</style>