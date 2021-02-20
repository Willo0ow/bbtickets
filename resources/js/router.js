import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import example from './components/ExampleComponent'


export default new VueRouter({
    mode:'history',
    base:'',
    routes:[
        {
            path:'',
            component: example
        }
    ]
})