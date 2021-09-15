import home from '../components/backend/home';


/*category----------------------*/
import category from '../components/backend/category/index';
import addCategory from '../components/backend/category/create';
import editCategory from '../components/backend/category/edit';


/*post----------------------*/
import post from '../components/backend/post/index';
import addPost from '../components/backend/post/create';
import editPost from '../components/backend/post/edit';



export const routes = [
    { path: '/home', component: home },

    { path: '/category', component: category },
    { path: '/category-create', component: addCategory },
    { path: '/category-edit/:slug', component: editCategory },


    { path: '/post', component: post },
    { path: '/post-create', component: addPost },
    { path: '/post-edit/:slug', component: editPost },

  ];