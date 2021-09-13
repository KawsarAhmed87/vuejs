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
    getCategories(){
      axios.get("category-list").then((response) => {
        console.log(response.data);
      }).catch((error)=> {
        console.log(error);
      })
    }
  },
  mutations: {
    
  }
}