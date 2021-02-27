import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import ticketBoard from './components/TicketBoard'
import ticket from './components/Ticket'
import appWindow from './components/AppWindow'

export default new VueRouter({
    mode:'history',
    base:'',
    routes:[
        {
            path:'',
            component: appWindow,
            children: [
                {
                    path: '',
                    component: ticketBoard
                },
                {
                    path: '/ticket/:type',
                    component: ticket
                }
            ]
        }
    ]
})