<template>
    <div class="card main-card">
        <div class="container-fluid main-box">
            <div class="card-header main-header d-flex align-items-end">
                <div class="font-weight-bold card-title-main-btn">BBTickets</div>
                <div class="card-title-sub-btn" :class="{'active-section': $route.path === section.path}" @click="redirectTo(section.path)" v-for="(section, idx) of sections" :key="idx">{{section.label}}</div>
                <div class="card-title-sub-btn search-input ml-auto">
                    <div class="input-group">
                        <input v-model="search" type="text" class="form-control" placeholder="np. Brak okucia..." aria-label="Szukaj" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <img src="/images/magnify.png" alt="">
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card-body">
                <div class="container sections-container">
                    <div class="row">
                        <div class="col-6" >
                            <div class="card section-card">
                                <div class="card-header">Formularz Zgłoszeniowy</div>
                                <div class="card-body">
                                    <div class="card ticket-card" >
                                        <label for="title">Temat</label>
                                        <input type="text" name="title" id="title" v-model="ticketForm.title">
                                        <label for="descriptiom">Opis</label>
                                        <textarea type="text" name="title" id="title" v-model="ticketForm.description"></textarea>
                                        <label for="department">Dział</label>
                                        <select name="department" id="department" v-model="ticketForm.department">
                                            <option v-for="(department, id) of departments" :key="id" :value="department.code" :label="department.label"></option>
                                        </select>
                                        <label for="category">Kategoria</label>
                                        <select name="category" id="category" v-model="ticketForm.category">
                                            <option v-for="(category, id) of filteredCategories" :key="id" :value="category.code" :label="category.label"></option>
                                        </select>
                                        <button @click="saveTicket">Wyślij</button>
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
import sections from '../mixins/sections'
    export default {
        mixins: [sections],
        data(){
            return{
                search: '',
                departments: null,
                categories: null,
                ticketForm:{
                    title: '',
                    description: '',
                    department: null,
                    category: null,
                    assignee: null,
                    status: 'registered',
                    priority: null,
                }
            }
        },
        computed: {
            filteredCategories(){
                let set = this.categories
                if(this.ticketForm.department){
                    set = this.categories.filter((category)=>category.department === this.ticketForm.department)
                }
                return set
            }
        },
        methods:{
            async retrieveDepartments(){
                let res = await axios.get('/department')
                this.departments = res.data
            },
             async retrieveCategories(){
                let res = await axios.get('/category')
                this.categories = res.data
            },
            async saveTicket(){
                if(this.checkRequiredInputs()){
                    alert('Błąd! Brakuje wymaganych informacji. Uzupełnij dane.')
                } else {
                    this.addAssignee()
                    await this.storeTicket()
                }
            },
            checkRequiredInputs(){
                return ['title', 'description', 'department', 'category'].some((info)=>!this.ticketForm[info])
            },
            addAssignee(){
                let categoryObject = this.categories.find((cat)=>cat.code === this.ticketForm.category)
                this.ticketForm.assignee = categoryObject.default_assignee
            },
            prepareTlog(){
                let tlog = {
                    variable: 'status',
                    value: 'registered',
                    correction: false,
                }
                return tlog
            },
            async storeTicket(){
                try{
                    let res = await axios.post('/ticket', {ticket: this.ticketForm, tlog: this.prepareTlog()})
                    alert('Ticket został pomyśnie zapisany.')
                } catch (err){
                    console.log(err);
                }
            },
            resetTicketForm(){
                this.ticketForm.title = ''
                this.ticketForm.description = ''
                this.ticketForm.department = null
                this.ticketForm.category = null
                this.ticketForm.assignee = null
                this.ticketForm.status = null
                this.ticketForm.priority = null
            }
        },
        async created() {
            await this.retrieveDepartments()
            await this.retrieveCategories()
        }
    }
</script>
<style scoped>
.main-box{
    margin: unset;
    padding: unset;
    height: 100%;
    width: 100%;
}
.main-card{
    height: 96%;
    margin: 2vh;
    border-radius: 20px;
    background-image:radial-gradient(rgb(77, 150, 179),rgba(44, 62, 80,1)) ;
    /* background:linear-gradient(145deg, #97b4c0,#396374, #2c3e50); */
/*     background: linear-gradient(145deg, #f2f8f9, #f3f9fb); */
    box-shadow:  20px 20px 55px #afcad6,
             -20px -20px 55px #cddbe4;
    border: none;
    overflow: hidden;
}
.main-header{
    border-bottom: none;
    border-top-right-radius: 2%;
    border-top-left-radius: 2%;
    background: #f5fafb;
    /* background-image:radial-gradient(rgb(57, 99, 116),rgba(44, 62, 80,1)) ; */
    box-shadow:  0 0 5px #bebebe;
}
.card-title-main-btn{
    font-weight: bolder;
    font-size: 1rem;
    margin-right: 10px;
}
.card-title-sub-btn{
    font-weight: lighter;
    font-size: 0.9rem;
    margin-right: 10px;
}
.search-input .form-control{
    border-radius: 20px;
    border: none;
    background:   #f3f3f3;
    box-shadow: inset 5px 5px 3px #dadada,
            inset -5px -5px 3px #f3f3f3;
}
.input-group-append{
    border-radius: 0px 50px 50px 0px;
    overflow: hidden;
}
.input-group-text{
    padding: 0;
    border: unset;
}
.input-group-append img{
    height: 50%;
    margin-left: 10px;
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
#registered{
    background-image:linear-gradient(145deg, #f5fafb, #dce4e6);
    box-shadow: inset 3px 3px 12px #5d6d70,
    inset -3px -3px 12px #5d6d70;
}
#registered .ticket-card{
        box-shadow:  5px 5px 10px #97a6ad,
                -3px -3px 10px #fbfbfb;
}
#verified{
    background-image:linear-gradient(145deg, #9fcfe6, #489ac0);
    box-shadow: inset 3px 3px 12px #28566b,
    inset -3px -3px 12px #28566b;
}
#verified .ticket-card{
        box-shadow:  5px 5px 10px #5a899e,
                -3px -3px 10px #b1dbee;
}
#in_progress{
    background-image:linear-gradient(145deg, #bda4da, #9969cf);
    box-shadow: inset 3px 3px 12px #604482,
    inset -3px -3px 12px #604482;
}
#in_progress .ticket-card{
        box-shadow:  5px 5px 10px #795c99,
                -3px -3px 10px #cab6e0;
}
#review{
    background-image:linear-gradient(145deg, #eedea8, #caac47);
    box-shadow: inset 3px 3px 12px #645627,
    inset -3px -3px 12px #645627;
}
#review .ticket-card{
        box-shadow:  5px 5px 10px #b18f1d,
                -3px -3px 10px #f3e3ad;
}
#on_hold{
    background-image:linear-gradient(145deg, #f5c7c7, #e66767);
    box-shadow: inset 3px 3px 12px #6b2828,
    inset -3px -3px 12px #6b2828;
}
#on_hold .ticket-card{
        box-shadow:  5px 5px 10px #bd6a6a,
                -3px -3px 10px #f1d1d1;
}
#closed{
    background-image:linear-gradient(145deg, #a5efc5, #60b585);
    box-shadow: inset 3px 3px 12px #389c63,
    inset -3px -3px 12px #3d654e;
}
#closed .ticket-card{
        box-shadow:  5px 5px 10px #269455,
                -3px -3px 10px #bbf9d4;
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
</style>
