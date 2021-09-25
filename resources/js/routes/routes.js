
/*backend---------------*/
import home from '../components/backend/home';

/*category*/
import category from '../components/backend/category/index';
import addCategory from '../components/backend/category/create';
import editCategory from '../components/backend/category/edit';


/*post*/
import post from '../components/backend/post/index';
import addPost from '../components/backend/post/create';
import editPost from '../components/backend/post/edit';



/*frontend---------------*/

import frontHome from '../components/frontend/Fronthome';
import frontAbout from '../components/frontend/About';
import frontCategory from '../components/frontend/Category';
import singlePost from '../components/frontend/Singlepost';



export const routes = [

    /*backend routes--------------*/

    { path: '/home', component: home },

    { path: '/category', component: category },
    { path: '/category-create', component: addCategory },
    { path: '/category-edit/:slug', component: editCategory },


    { path: '/post', component: post },
    { path: '/post-create', component: addPost },
    { path: '/post-edit/:id', component: editPost },



    /*frontend/public routes-----------*/

    { path: '/', component: frontHome},
    { path: '/about', component: frontAbout},
    { path: '/category/:slug', component: frontCategory},
    { path: '/single-post/:id', component: singlePost},



  ];