<template>
   <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category list</h3>

          <div class="card-tools">
            <router-link to="/category-create" class="btn btn-block btn-success btn-sm">Add category</router-link>
          </div>
        </div>
        <div class="card-body">
         <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 5%">SL</th>
                      <th style="width: 30%">Name</th>
                      <th style="width: 20%">Slug</th>
                      <th style="width: 15%">Status</th>
                      <th style="width: 15%">Created</th>
                      <th style="width: 15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category, index) in categories">
                      <td>{{index+1}}</td>
                      <td>{{category.name}}</td>
                      <td>{{category.slug}}</td>
                      <td>{{statusName(category.status)}}</td>
                      <td>{{category.created_at | time }}</td>
                      <td>
                        <router-link :to="`/category-edit/${category.id}`" class="btn btn-success btn-sm">Edit</router-link>
                       
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">Delete</button>
                      </td>
                    </tr>
                    <tr v-if="emptyData()">
                        <td colspan="5"><h5 class="text-center text-danger">No data found!</h5></td>
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
  mounted() {
    this.$store.dispatch("getCategories");
  },
  computed:{
    categories(){
      return this.$store.getters.categories;
    }
  },
  methods: {

    statusName: function(status){
      let data = {
        0: "In-Active", 1: "Active"
      }

      return data[status];
    },

    deleteCategory: function(id){

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
             axios.get('category-delete/'+id).then((response)=>{
                toastr.error('Data deleted successfully!', 'Deleted');
                this.$store.dispatch("getCategories");
              }).catch((error) => {

              })

          }
        })

    },

    emptyData: function(){
      return (this.categories.length < 1);
    }
  },
}
</script>

<style>

</style>