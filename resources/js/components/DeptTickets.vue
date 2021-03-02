<template>
<div v-if="grouppedTickets">
    <div class="row mb-4">
        <div class="col cols-12 d-flex justify-content-end">
            <button v-for="(group, idx) of grouppedTickets" :key="idx" class="category-btn" :class="{active: category === group.code}" @click="category = group.code">{{group.label}}</button>
        </div>
    </div>
    <div class="row mb-4" v-if="selectedTicketGroup">
        <div class="col">
            <div class="card section-card" :id="selectedTicketGroup.code">
                <div class="card-header">{{selectedTicketGroup.label}}</div>
                <div class="card-body">
                    <div class="card ticket-card group-header">
                        <div class="card-body d-flex justify-content-space-between">
                            <div :style="{width: column.width, 'text-align': 'center'}" v-for="(column, index) of ticketColumns" :key="index">{{column.label}}</div>
                            <div style="width:15%; text-align:center">Osoba</div>
                        </div>
                    </div>
                    <div class="card ticket-card" v-for="ticket of selectedTicketGroup.tickets" :key="`ticket${ticket.id}`">
                        <div class="card-body d-flex justify-content-space-between">
                            <div class="ticket-col" :style="{width: column.width, 'text-align':'center'}" v-for="(column, index) of ticketColumns" :key="index">
 <!--                                <button v-if="column.value === 'assignee_name'" type="button" class="btn btn-default" aria-label="Assign">
                                    <i class="mdi mdi-account" aria-hidden="false"></i>
                                </button> -->
                                {{ticket[column.value]}}
                            </div>
                            <div class="ticket-col" style="width: 15%">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ticket.assignee_name}}
                                    </button>
                                    <div v-if="departmentUsers" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" type="button" v-for="user of departmentUsers" :key="user.id" @click="selectNewAssignee({user: user.id, ticketId: ticket.id})">{{user.name}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ticket-col" style="width: 10%">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{getPriorityLabel(ticket.priority)}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" type="button" v-for="(label, priority) in priorities" :key="priority" @click="selectNewPriority({priority, ticketId: ticket.id})">{{label}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>


<script>
    import axios from '../axios'
    export default {
        data(){
            return{
                departmentUsers:null,
                category: null,
                dept: null,
                search: '',
                tickets: null,
                grouppedTickets: null,
                ticketColumns:[
                    {label: 'Uzytkownik', value: 'user_name', width: '10%'},
                    {label: 'Temat', value: 'title', width: '20%'},
                    {label: 'Kategoria', value: 'cat_label', width: '25%'},
                    //{label: 'Osoba', value: 'assignee_name', width: '10%'},
                    {label: 'Dział', value: 'dept_label', width: '10%'},
                    //{label: 'Priorytet', value: 'priority', width: '10%'},
                    {label: 'Stworzono', value: 'created_at', width: '10%'}
                ],
                priorities: {
                    5: 'Na wczoraj',
                    4: 'Wysoki',
                    3: 'Podwyzszony',
                    2: 'Średni',
                    1: 'Niski'
                }
            }
        },
        computed:{
            selectedTicketGroup(){
                return this.grouppedTickets.find((group)=>group.code === this.category)
            }
        },
        methods:{
            getPriorityLabel(priority){
                return this.priorities[priority] ? this.priorities[priority] : 'brak'
            },
            async selectNewPriority({priority, ticketId}){
                const form = {priority}
                const tlog = {ticket: ticketId, variable: 'priority', value: priority, correction: true}
                await axios.patch(`/ticket/${ticketId}`, {ticket: form, tlog})
                await this.getDeparmentTickets()
            },
            async selectNewAssignee({user, ticketId}){
                const form = {assignee: user}
                const tlog = {ticket: ticketId, variable: 'assignee', value: user, correction: true}
                await axios.patch(`/ticket/${ticketId}`, {ticket: form, tlog})
                await this.getDeparmentTickets()
            },
            async retrieveDeptTickets(){
                let res = await axios.get(`/opendepttickets/${this.dept}`)
                this.tickets = res.data
            },
            async getDeparmentTickets(){
                await this.retrieveDeptTickets()
                this.groupTicketsByStatus()
                this.sortTicketGroups()
            },
            async retrieveDepartmentUsers(){
                let res = await axios.get(`/departmentusers/${this.dept}`)
                this.departmentUsers = res.data
            },
            groupTicketsByStatus(){
                this.grouppedTickets = this.tickets.reduce((groups, ticket)=>{
                    let ticketGroupIndex = groups.findIndex((group)=>group.code === ticket.status)
                    if(ticketGroupIndex<0){
                        groups.push({code: ticket.status, label: ticket.stat_label, seq: ticket.sequence, tickets:[ticket]})
                    } else {
                        groups[ticketGroupIndex].tickets.push(ticket)
                    }
                    return groups
                }, [])
            },
            assignDept(){
                this.dept = this.$route.params.department
            },
            sortTicketGroups(){
                this.grouppedTickets = this.grouppedTickets.sort((a,b)=>a.seq - b.seq)
            }
        },
        async created(){
            this.assignDept()
            await this.retrieveDepartmentUsers()
            await this.getDeparmentTickets()

        }
    }
</script>
<style scoped>
.category-btn{
    padding: 5px 20px;
    margin: 0 10px;
    border: none;
    border-radius: 25px;
    text-transform: uppercase;
    color: rgb(97, 97, 109);
    background-image: linear-gradient(145deg, #f4f6fb, #eef3f9);
    box-shadow: -2px -2px 3px rgb(253, 254, 255),
    2px 2px 2px rgb(188 194 199);

}
.category-btn:hover{
    box-shadow: -5px -5px 5px rgb(253, 254, 255),
        5px 5px 5px rgb(188 194 199);

}
.category-btn.active{
    box-shadow: inset -3px -3px 3px rgb(252 253 255), 
    inset 3px 3px 3px rgb(188 194 199);
    color: rgb(51, 51, 63);
    
}
.sections-container{
    max-width: 1800px;
}
.section-card{
    height: 100%;
    padding: 5px;
    text-align: center;
    border:none;
    border-radius: 10px;

}
.ticket-col{
    align-self: center;
}
#registered{
    background-image:linear-gradient(145deg, #f5fafb, #dce4e6);
        box-shadow: inset 3px 3px 6px #c5ccce, inset -3px -3px 6px #c1cfd2;
}
#registered .ticket-card{
        box-shadow:  5px 5px 5px #bfcdd4, -2px -3px 5px #dfe7ef;
}
#verified{
    background-image:linear-gradient(145deg, #d7e8f1, #b0d6e8);
        box-shadow: inset 3px 3px 6px #acccda, inset -3px -3px 6px #a7cada;
}
#verified .ticket-card{
        box-shadow: 5px 5px 5px #a0c7d8, -2px -3px 5px #d5e8f1;
}
#in_progress{
    background-image:linear-gradient(145deg,  #e6dcf1, #d0bee4);
        box-shadow: inset 3px 3px 5px #bca9d2, inset -3px -3px 5px #b6a3ce
}
#in_progress .ticket-card{
        box-shadow:   5px 5px 5px #c4ace0, -2px -3px 5px #d3c4e4;
}
#review{
    background-image:linear-gradient(145deg,  #ece6d1, #e6d9af);
        box-shadow: inset 3px 3px 6px #d8c793, inset -3px -3px 6px #dcce9b;
}
#review .ticket-card{
        box-shadow: 5px 5px 5px #d8c892, -3px -3px 5px #e6dcb9;
}
#on_hold{
    background-image:linear-gradient(145deg, #efdede, #e6b8b8);
        box-shadow: inset 3px 3px 6px #bd8b8b, inset -3px -3px 6px #c7a3a3
}
#on_hold .ticket-card{
        box-shadow:  5px 5px 5px #dcb8b8, -3px -3px 5px #dcb8b8;
}
#closed{
    background-image:linear-gradient(145deg, #ddefe5, #b1e0c6);
    box-shadow: inset 3px 3px 6px #8ac1a2, inset -3px -3px 6px #8ac1a2
}
#closed .ticket-card{
        box-shadow: 5px 5px 5px #a3d8b9, -2px -3px 5px #bde8cf;
}
.section-card>.card-header{
    padding: 10px;
    text-transform: uppercase;
    font-size: 0.8rem;
    border-bottom: none;
    background-color: unset;
}
.section-card>.card-body{
    padding: 0 10px 10px 10px;
    overflow-y: scroll;
    max-height: 80vh;
}
.ticket-card{
    box-sizing: border-box;
    text-align: start;
    border:none;
    border-radius: 10px;
    background: linear-gradient(150deg, #fcfcfc, #fcfcfc);
/*     box-shadow:  5px 5px 10px #bdbdbd,
                -3px -3px 10px #f5f5f5; */
    margin: 10px 0;
    color: #707275;
    }
.ticket-card .card-header{
    background: transparent;
    padding: 2px 6px;
    border-bottom: unset;
    font-size: 0.7rem;
}
.group-header{
        background: linear-gradient(150deg,#b1b1b1, #606060);;
        box-shadow:  3px 3px 6px #9aa2a5,
                -3px -2px 5px #ebeff5c5 !important;
                color: white;
}
</style>
