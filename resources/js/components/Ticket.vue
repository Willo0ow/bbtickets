<template>
        <div class="card main-card">
    <div class="container-fluid main-box">
                    <div class="card-header main-header d-flex align-items-end">
                        <div class="font-weight-bold card-title-main-btn">Ticket</div>
                        <div class="card-title-sub-btn font-weight-light fs-6">Wszyskie</div>
                        <div class="card-title-sub-btn">Moje</div>
                        <div class="card-title-sub-btn">Nowe</div>
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
                        </div>
                    </div>
        </div>
    </div>
</template>


<script>
import magnify from '../../images/magnify.png'
    export default {
        data(){
            return{
                search: '',
                departmesnts: null,
                categories:[
                    {label:'Problem BBSoftware', code:'bbsoftware'},
                    {label:'Potrzeba zmiany technologicznej', code:'tech_changes'},
                    {label:'Problem z winpro 10', code:'winX'},
                    {label:'Błędy technologiczne w zamówieniu', name:'incorrect_tech'},
                    {label:'Problem z zamówieniem', name:'orders'},
                    {label:'Potrzebny kontakt z klientem', name:'client'}
                ],
                ticketForm:{
                    title: '',
                    description: '',
                    department: null,
                    //user: null,
                    category: null,
                    asignee: null,
                    status: null,
                    priority: null,
                    estimated_close_date: null,
                    close_date: null
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
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
