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
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category, index) in categories">
                      <td>{{index+1}}</td>
                      <td>{{category.name}}</td>
                      <td>{{category.slug}}</td>
                      <td>{{category.status}}</td>
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
  }
}
</script>

<style>

</style>