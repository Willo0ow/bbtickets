<template>
    <div class="row d-flex justify-content-center">
        <div class="col-6" >
            <div class="card section-card" id="form-box">
                <div class="card-header">Formularz Zgłoszeniowy</div>
                <div class="card-body">
                    <div class="card ticket-card" >
                        <label for="title">Temat</label>
                        <input type="text" class="form-control" name="title" id="title" v-model="ticketForm.title">
                        <label for="descriptiom">Opis</label>
                        <textarea type="text" class="form-control" name="title" id="title" v-model="ticketForm.description"></textarea>
                        <label for="department">Dział</label>
                        <select name="department" id="department" v-model="ticketForm.department">
                            <option v-for="(department, id) of departments" :key="id" :value="department.code" :label="department.label"></option>
                        </select>
                        <label for="category">Kategoria</label>
                        <select name="category" id="category" v-model="ticketForm.category">
                            <option v-for="(category, id) of filteredCategories" :key="id" :value="category.code" :label="category.label"></option>
                        </select>
                        <br />
                        <button id="send-btn" @click="saveTicket">Wyślij</button>
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
#form-box .form-control, #form-box select{
    border-radius: 20px;
    border: none;
    background:   #f3f3f3;
    box-shadow: inset 5px 5px 3px #dadada,
            inset 0px -5px 3px #f3f3f3;
}
#form-box select{
    min-height: 25px;
    padding: 3px  5px;
}
.input-group-text{
    padding: 0;
    border: unset;
}
.sections-container{
    max-width: 1800px;
}
.section-card{
    padding: 5px;
    text-align: center;
    border:none;
    border-radius: 10px;

}
#form-box{
    background-image:linear-gradient(145deg, #f5fafb, #dce4e6);
    background-color: unset;
    box-shadow: inset 3px 3px 12px #aabdc0,
    inset -3px -3px 12px #c5cbcc;
}
#form-box .card{
    background-color: unset;

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
    margin: 10px 0;
    color: #707275;
}
#send-btn{
    background-image: linear-gradient(175deg, #ececec, #f1f1f1);
    box-shadow: 3px 4px 5px #cad1d2, -5px -7px 10px #e6e6e6;
    border: none;
    border-radius: 25px;
    width: 50%;
    margin: 0 auto;
}
label{
    margin: 10px 0 3px;
}
</style>
