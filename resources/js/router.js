import {createRouter, createWebHistory} from 'vue-router';
import { routesConfig } from "./routesConfig";

const routes = [...routesConfig]
const router = createRouter ({
    history:createWebHistory(),
    routes
})
export default router