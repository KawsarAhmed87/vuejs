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
                      <td style="width: 8%"><input type="checkbox" :disabled="emptyData()" @click="allSelect" v-model="selectedAll"> All</td>
                      <th style="width: 5%">SL</th>
                      <th style="width: 30%">Name</th>
                      <th style="width: 20%">Slug</th>
                      <th style="width: 10%">Status</th>
                      <th style="width: 15%">Created</th>
                      <th style="width: 12%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category, index) in categories">
                      <td><input type="checkbox"  :value="category.id" v-model="selectedData"></td>
                      <td>{{index+1}}</td>
                      <td>{{category.name | sortName(10) }}</td>
                      <td>{{category.slug}}</td>
                      <td>{{statusName(category.status)}}</td>
                      <td>{{category.created_at | time }}</td>
                      <td>
                        <router-link :to="`/category-edit/${category.slug}`" class="btn btn-success btn-sm">Edit</router-link>
                       
                        <button type="button" class="btn btn-danger btn-sm" @click="deleteCategory(category.id)">Delete</button>
                      </td>
                    </tr>
                     <tr v-if="!emptyData()">
                        <td colspan="5">
                          <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" :disabled="!isSelected" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                              Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <button type="button" @click="changeStatus(selectedData, 1)" class="dropdown-item" >Active</button type="button">
                              <button type="button" @click="changeStatus(selectedData, 0)" class="dropdown-item" >In-active</button type="button">
                              <button type="button" @click="removeItems(selectedData)" class="dropdown-item" >Delete</button type="button">
                             
                            </div>
                          </div>
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
  data: function(){
    return {
      selectedAll: false,
      selectedData: [],
      isSelected: false,
    }
  },
  mounted() {
    this.$store.dispatch("getCategories");
  },
  watch:{
    selectedData: function(selectedData){
      this.isSelected = (selectedData.length > 0);
      this.selectedAll = (selectedData.length == this.categories.length);
    }
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

      this.confirm(()=> {
        axios.get('category-delete/'+id).then((response)=>{
            toastr.error('Data deleted successfully!', 'Deleted');
            this.$store.dispatch("getCategories");
          }).catch((error) => {

          })
      });

    },

    emptyData: function(){
      return (this.categories.length < 1);
    },

    allSelect: function(event){
      if(event.target.checked == false){
        this.selectedData = [];
      }else{
        this.categories.forEach((category) =>{
          if (this.selectedData.indexOf(category.id) == -1) {
            this.selectedData.push(category.id);
          }
        });
      }
    },

    removeItems: function(selectedData){
      this.confirm(()=> {
        axios.post("categories/bulk-delete", {dataSelect: selectedData}).then((response) =>{
          this.selectedAll = false;
          this.selectedData = [];
          this.isSelected = false;
          toastr.error('Data deleted successfully!', 'Deleted');
          this.$store.dispatch("getCategories");
          }).catch((error) => {

          })
      });

    },

    changeStatus: function(selectedData, statusInfo){
      let message = statusInfo === 1 ? "active" : "in-active"
      axios.post("categories/change-status", {dataSelect: selectedData, statusInfo: statusInfo}).then((response) =>{
         this.selectedAll = false;
          this.selectedData = [];
          this.isSelected = false;
       toastr.success('Data ' +message+' status changed successfully!', 'Status');
        this.$store.dispatch("getCategories");
      }).catch((error) => {

      });
    },


  },
}
</script>

<style>

</style>