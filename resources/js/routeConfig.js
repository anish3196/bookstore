import board from './components/pages/dashboard.vue'
import book from './admin/pages/bookCollection.vue'
import user from './admin/pages/users.vue'
import login from './admin/pages/login.vue'


export const dashBoard = {
    path: "/",
    name: "dashBoard",
    component:board,
};

export const bookCollection ={
    path: "/bookcollection",
    name:"bookCollection",
    component:book,
}

export const Users ={
    path: "/users",
    name:"Users",
    component:user,
}

export const Login ={
    path: "/login",
    name:"Login",
    component:login,
}