import Login from './components/auth/Login.vue'
import AllDrink from './components/AllDrink.vue';
import CreateDrink from './components/CreateDrink.vue';
import EditDrink from './components/EditDrink.vue';
import MyDrinks from './components/MyDrinks.vue';
import AddMyDrink from './components/AddMyDrink.vue';

export const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login,
        meta: {
            allowAnonymous: true
        }
    },
    {
        name: 'home',
        path: '/',
        component: AllDrink,
        meta: {
            allowAnonymous: false
        }
    },
    {
        name: 'create',
        path: '/create',
        component: CreateDrink,
        meta: {
            allowAnonymous: false
        }
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditDrink,
        meta: {
            allowAnonymous: false
        }
    },
    {
        name: 'my-drinks',
        path: '/my-drinks',
        component: MyDrinks,
        meta: {
            allowAnonymous: false
        }
    },
    {
        name: 'add-my-drink',
        path: '/add-my-drink',
        component: AddMyDrink,
        meta: {
            allowAnonymous: false
        }
    }
];
