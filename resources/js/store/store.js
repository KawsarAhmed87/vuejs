export default{
  state: {
    categoryData : []
  },
  
  getters: {
    
    categories(state){
      return state.categoryData;
    }
    
  },
  actions: {
    getCategories(data){
      axios.get("category-list").then((response) => {
        data.commit("categoryDatas", response.data.categories);
     

      }).catch((error)=> {
        console.log(error);
      })
    }
  },
  mutations: {
    categoryDatas(state, stateData){
      return state.categoryData = stateData;
    }
  }
}