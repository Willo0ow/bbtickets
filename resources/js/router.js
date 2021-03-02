import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import ticketBoard from './components/TicketBoard'
import ticket from './components/Ticket'
import appWindow from './components/AppWindow'
import userTickets from './components/UserTickets'
import deptTickets from './components/DeptTickets'

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
                },
                {
                    path: '/tickets/:user',
                    component: userTickets
                },
                {
                    path: '/tickets/manage/:department',
                    component: deptTickets
                }
            ]
        }
    ]
})