<template>
   <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create a new category</h3>

          <div class="card-tools">
            <router-link to="/category" class="btn btn-block btn-success btn-sm">Category list</router-link>
          </div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" @submit.prevent="submitForm" @keydown="form.onKeydown($event)"> 
                <div class="card-body">
                  <div class="form-group row">
                    <label for="categoryName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="categoryName" placeholder="Name" v-model="form.name" >
                      <HasError :form="form" field="name" />

                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="activeCheck" value="1" v-model="form.status">
                        <label class="form-check-label" for="activeCheck">Active</label>
                        
                        </div>
                         <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inActiveCheck" value="0" v-model="form.status">
                        <label class="form-check-label" for="inActiveCheck">Inactive</label>
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
export default {

    name: "create",
    data: () => ({
    form: new Form({
      name: null,
      status: 1,
      
    })
  }),

  methods: {
    async submitForm () {
    let alterThis = this;
      const response = await this.form.post('/category-create')
        .then(function(data){
            /*Toast.fire({
            icon: 'success',
            title: 'Saved data successfully',
          }) */

          toastr.success('Data saved successfully!', 'Success');
        })
        
        //alterThis.$router.push("/category");

        alterThis.form.name = null;
    }
  }

}
</script>

<style>

</style>