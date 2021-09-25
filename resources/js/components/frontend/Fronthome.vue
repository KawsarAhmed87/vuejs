<template>
<div>


<div class="body-content">
  <div class="container">
    <div class="row">
      <div class="blog-page">
        <div class="col-md-9">
      


    


      <div class="blog-post wow fadeInUp" v-for="post in getPosts">
  <a href="blog-details.html"><img class="img-responsive" src="images/blog-post/blog_big_03.jpg" alt=""></a>
  <h1><a href="blog-details.html">Nemo enim ipsam voluptatem quia voluptas sit aspernatur</a></h1>
  <span class="author">Mark Doe</span>
  <span class="review">6 Comments</span>
  <span class="date-time">14/06/2014 11.00AM</span>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...</p>
  <a href="#" class="btn btn-upper btn-primary read-more">read more</a>
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
    name : "Fronthome",
    components: {
        'sidebar' : Sidebar
    },

    data: function(){
    return {
    
    }
  },
  mounted() {
    this.$store.dispatch("getActionPostFront");
  },
  watch:{
    
  },
  computed:{
    getPosts(){
      return this.$store.getters.getPostsFront;
    }
  },

}
</script>

<style>

</style>