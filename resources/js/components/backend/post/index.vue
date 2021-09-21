<template>
   <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Post list</h3>

          <div class="card-tools">
            <router-link to="/post-create" class="btn btn-block btn-success btn-sm">Add post</router-link>
          </div>
        </div>
        <div class="card-body">
         <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td style="width: 8%"><input type="checkbox" :disabled="emptyData()" @click="allSelect" v-model="selectedAll"> All</td>
                      <th>SL</th>
                      <th>User</th>
                      <th>Category</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Image</th>
                      <th>Statsu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(post, index) in posts">
                      <td><input type="checkbox"  :value="post.id" v-model="selectedData"></td>
                      <td>{{index+1}}</td>
                      <td>{{post.user.name}}</td>
                      <td>{{post.category.name}}</td>
                      <td>{{post.title | sortName(20)}}</td>
                      <td>{{post.content | sortName(20)}}</td>
                      <td><img width="75px" :src="imageLink(post.thumbnail)"></td>
                      <td>{{post.status | firtUpper }}</td>
                      
                      <td width="12%">
                        <router-link :to="`post-edit/${post.id}`" class="btn btn-success btn-sm">Edit</router-link>
                       
                        <button type="button" class="btn btn-danger btn-sm" @click="deletePost(post.id)">Delete</button>
                      </td>
                    </tr>
                    <tr v-if="!emptyData()">
                        <td colspan="5">
                          <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" :disabled="!isSelected" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                              Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <button type="button" @click="changeStatus(selectedData, 'published')" class="dropdown-item" >Published</button type="button">
                              <button type="button" @click="changeStatus(selectedData, 'draft')" class="dropdown-item" >Draft</button type="button">
                              <button type="button" @click="removeItems(selectedData)" class="dropdown-item" >Delete</button type="button">
                             
                            </div>
                          </div>
                        </td>
                    </tr>
                    <tr v-if="emptyData()">
                        <td colspan="8"><h5 class="text-center text-danger">No data found!</h5></td>
                    </tr>
              
                  </tbody>
                </table>
        </div>
        <!-- /.card-body -->
         <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
        <!-- /.card-footer-->
      </div>

    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  name: "index",
  data: function(){
    return {

      selectedAll: false,
      selectedData: [],
      isSelected: false,
  
     
    }
  },
  mounted() {
    this.$store.dispatch("getPosts");
  },

  watch:{
    selectedData: function(selectedData){
      this.isSelected = (selectedData.length > 0);
      this.selectedAll = (selectedData.length == this.posts.length);
    }
  },
  computed:{
    posts(){
      return this.$store.getters.posts;
    }
  },
  methods: {

   
    deletePost: function(id){

      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
             axios.get('post-delete/'+id).then((response)=>{
                toastr.error('Data deleted successfully!', 'Deleted');
                 this.selectedAll = false;
                  this.selectedData = [];
                  this.isSelected = false;
                this.$store.dispatch("getPosts");
              }).catch((error) => {

              })

          }
        })

    },

    emptyData: function(){
      return (this.posts.length < 1);
    },

    allSelect: function(event){
      if(event.target.checked == false){
        this.selectedData = [];
      }else{
        this.posts.forEach((post) =>{
          if (this.selectedData.indexOf(post.id) == -1) {
            this.selectedData.push(post.id);
          }
        });
      }
    },


    removeItems: function(selectedData){
      this.confirm(()=> {
        axios.post("posts/bulk-delete", {dataSelect: selectedData}).then((response) =>{
          this.selectedAll = false;
          this.selectedData = [];
          this.isSelected = false;
          toastr.error('Data deleted successfully!', 'Deleted');
          this.$store.dispatch("getPosts");
          }).catch((error) => {

          })
      });

    },


     changeStatus: function(selectedData, statusInfo){
      let message = statusInfo === 'published' ? "Published" : "Draft"
      axios.post("posts/change-status", {dataSelect: selectedData, statusInfo: statusInfo}).then((response) =>{
         this.selectedAll = false;
          this.selectedData = [];
          this.isSelected = false;
       toastr.success('Data ' +message+' status changed successfully!', 'Status');
        this.$store.dispatch("getPosts");
      }).catch((error) => {

      });
    },

    



  },
}
</script>

<style>

</style>