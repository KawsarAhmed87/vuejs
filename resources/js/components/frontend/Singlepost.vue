<template>
<div>


<div class="body-content">
  <div class="container">
    <div class="row">
      <div class="blog-page">
        <div class="col-md-9">
    
      <div class="blog-post wow fadeInUp">
    <router-link :to="`/single-post/${post.id}`"><img class="img-responsive" :src="imageLink(post.thumbnail)" alt=""></router-link>
  <h1><router-link :to="`/single-post/${post.id}`">{{post.title}}</router-link></h1>
  <span class="author">{{post.user.name}}</span>
  <span class="date-time">{{post.created_at | time }}</span>

  <div v-html="post.content"></div>
</div>

    </div>
        <div class="col-md-3 sidebar">
                
                
                
          <div class="sidebar-module-container">
            <div class="search-area outer-bottom-small">
    <form>
        <div class="control-group">
            <input placeholder="Type to search" class="search-field">
            <a href="#" class="search-button"></a>   
        </div>
    </form>
</div>    

<div class="home-banner outer-top-n outer-bottom-xs">
<img src="images/banners/LHS-banner.jpg" alt="Image">
</div>
        <!-- ==============================================CATEGORY============================================== -->

        <sidebar></sidebar>

  <!-- ============================================== CATEGORY : END ============================================== -->           


<!-- ============================================== PRODUCT TAGS : END ============================================== -->         
</div>
        </div>
      </div>
    </div>
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->  </div>
</div>


</div>
</template>

<script>
import Sidebar from "./Sidebar";
export default {

    name : "Singlepost",
    components: {
        'sidebar' : Sidebar
    },

    data: function(){
    return {
        post : {}
    }
  },

   mounted() {
    this.getPostData();
    
  },


   methods: {
  
    getPostData: function(){
      let this_post = this;
      axios.get("/post-single/" + this.$route.params.id).then((response)=>{
        this.post = response.data.post;
       // this_post.form.fill(response.data.post);

      }).catch((error) => {

      })
    },

  }


}
</script>

<style>

</style>