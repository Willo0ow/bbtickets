<template>
<div v-if="grouppedTickets">
    <div class="row mb-4" v-for="group of grouppedTickets" :key="group.seq">
        <div class="col">
            <div class="card section-card" :id="group.code">
                <div class="card-header">{{group.label}}</div>
                <div class="card-body">
                    <div class="card ticket-card group-header">
                        <div class="card-body d-flex justify-content-space-between">
                            <div :style="{width: column.width}" v-for="(column, index) of ticketColumns" :key="index">{{column.label}}</div>
                            <div style="width:10%">Zamknięcie</div>
                        </div>
                    </div>
                    <div class="card ticket-card" v-for="ticket of group.tickets" :key="`ticket${ticket.id}`">
                        <div class="card-body d-flex justify-content-space-between">
                            <div class="ticket-col" :style="{width: column.width}" v-for="(column, index) of ticketColumns" :key="index">{{ticket[column.value]}}</div>
                            <div class="ticket-col" style="width:10%">{{ticket.close_date? ticket.close_date : ticket.estimated_close_date}}</div>
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
                search: '',
                tickets: null,
                grouppedTickets: null,
                ticketColumns:[
                    {label: 'Temat', value: 'title', width: '20%'},
                    //{label: 'Opis', value: 'description', width: '20%'},
                    {label: 'Kategoria', value: 'cat_label', width: '30%'},
                    {label: 'Osoba', value: 'assignee_name', width: '10%'},
                    {label: 'Dział', value: 'dept_label', width: '10%'},
                    {label: 'Priorytet', value: 'priority', width: '10%'},
                    {label: 'Stworzono', value: 'created_at', width: '10%'}
                ]
            }
        },
        methods:{
            async retrieveUserTickets(){
                let res = await axios.get(`/usertickets/${this.userId}`)
                this.tickets = res.data
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
            assignUserId(){
                this.userId = this.$route.params.user
            },
            sortTicketGroups(){
                this.grouppedTickets = this.grouppedTickets.sort((a,b)=>a.seq - b.seq)
            }
        },
        async created(){
            this.assignUserId()
            await this.retrieveUserTickets()
            this.groupTicketsByStatus()
            this.sortTicketGroups()

        }
    }
</script>
<style scoped>
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
