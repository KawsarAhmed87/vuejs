export default{
  state: {
    categoryData : [],
    PostData : []
  },
  
  getters: {
    
    categories(state){
      return state.categoryData;
    },

    posts(state){
      return state.PostData;
    }
    
  },
  actions: {
    getCategories(data){
      axios.get("category-list").then((response) => {
        data.commit("categoryDatas", response.data.categories);
     

      }).catch((error)=> {
       
      })
    },

    getActiveCategories(data){
      axios.get("category-active-list").then((response) => {
        data.commit("categoryDatas", response.data.categories);
     

      }).catch((error)=> {
        
      })
    },

    getPosts(data){
      axios.get("post-list").then((response) => {
        data.commit("postDatas", response.data.posts);
     
      }).catch((error)=> {
        
      })
    },

  },
  mutations: {
    categoryDatas(state, stateData){
      state.categoryData = stateData;
    },

    postDatas(state, stateData){
      state.PostData = stateData;
    }
  }
}