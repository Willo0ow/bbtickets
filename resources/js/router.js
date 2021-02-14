import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from '../axios'

import dashboard from './components/Dashboard'
import settings from './components/Settings'
import permissions from './components/Permissions'
import postCapabilities from './components/PostCapabilities'
import {store} from '@/Home/home.js'

async function waitForPermissions(permission){
    if(!store.state.user.permissions){
        setTimeout( async  function() {
            await waitForPermissions(permission);
          }, 100);
    } else {
        return checkPermissions(permission)
    }
}
function  checkPermissions(permission){
    return permission? store.state.user.permissions.includes(permission) : true
}


Vue.use(VueRouter)
export default new VueRouter({
    mode:'history',
    base:'',
    routes:[
        {
            path:'',
            component: dashboard
        },
        {
            path: '/settings',
            component: settings,
            beforeEnter: async (to, from, next) => {
                if(await waitForPermissions('settings')) {
                    next()
                } else {
                    next({path:''})
                }
            }
        },
        {
            path: '/settings/permissions',
            component: permissions,
            beforeEnter: async (to, from, next) => {
                if(await waitForPermissions('permission-settings')) {
                    next()
                } else {
                    next({path:''})
                }
            }
        },
        {
            path: '/settings/capabilities',
            component: postCapabilities,
            beforeEnter: async (to, from, next) => {
                if(await waitForPermissions('capability-settings')) {
                    next()
                } else {
                    next({path:''})
                }
            }
        }
    ]
})