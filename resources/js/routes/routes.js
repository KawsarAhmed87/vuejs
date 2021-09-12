import home from '../components/backend/home';
import category from '../components/backend/category/index';
import addCategory from '../components/backend/category/create';

export const routes = [
    { path: '/home', component: home },
    { path: '/category', component: category },
    { path: '/category-create', component: addCategory },

  ];