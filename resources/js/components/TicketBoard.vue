<template>
    <div class="row">
        <div class="col-2" v-for="(category, id) of categories" :key="id">
            <div class="card section-card" :id="category.name">
                <div class="card-header">{{category.label}}</div>
                <div class="card-body">
                    <div class="card ticket-card" v-for="n in category.tickets" :key="n+'ticket'+id">
                        <div class="card-header">Temat</div>
                        <div class="card-body"></div>
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
                statuses: null,
                categories:[
                    {label:'Zgłoszone', name:'registered', tickets: 38},
                    {label:'Zweryfikowane', name:'verified', tickets: 50},
                    {label:'W Trakcie', name:'in_progress', tickets: 45},
                    {label:'Do Konsultacji', name:'review', tickets: 28},
                    {label:'Wstrzymane', name:'on_hold', tickets: 17},
                    {label:'Ukończone', name:'closed', tickets: 20}
                ]
            }
        },
        async created() {
            let res = await axios.get('/typestatuses/ticket')
            this.statuses = res.data
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
    background: linear-gradient(150deg,#f1f7fb, #fbfdff);
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
