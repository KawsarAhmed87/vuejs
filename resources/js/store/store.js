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
        console.log(error);
      })
    },

    getPosts(data){
      axios.get("post-list").then((response) => {
        data.commit("postDatas", response.data.posts);
     

      }).catch((error)=> {
        console.log(error);
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