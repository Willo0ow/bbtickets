<template>
        <div class="card main-card">
    <div class="container-fluid main-box">
                    <div class="card-header main-header d-flex align-items-end">
                        <div class="font-weight-bold card-title-main-btn">BBTickets</div>
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
                        <div class="container">
                            <div class="row">
                                <div class="col-3" v-for="(category, id) of categories" :key="id">
                                    <div class="card section-card">
                                        <div class="card-header">{{category}}</div>
                                        <div class="card-body">
                                            <div class="card ticket-card" v-for="n in 5" :key="n+'ticket'+id">
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
                categories:['Zgłoszone', 'Zweryfikowane', 'W Trakcie', 'Ukończone']
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
    border-radius: 2%;
    box-shadow:  20px 20px 30px #c7c7c7,
             -20px -20px 30px #ebebeb;
    border: none;
    overflow: hidden;
}
.main-header{
    border-bottom: none;
    border-top-right-radius: 2%;
    border-top-left-radius: 2%;
    background: transparent;
    background: linear-gradient(145deg, #f7f7f7, #f8f8f8);
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
.section-card{
    height: 100%;
    padding: 5px;
    text-align: center;
    background: #f9f9f9;
    border:none;
    border-radius: 10px;
    box-shadow: inset 5px 5px 10px #dddddd,
             inset -5px -5px 10px #f5f5f5;
    
}
.section-card>.card-header{
    padding: 10px;
    text-transform: uppercase;
    font-size: 0.8rem;
    border-bottom: none;
    background-color: unset;
}
.section-card>.card-body{
    padding: 10px;
}
.ticket-card{
    box-sizing: border-box;
    text-align: start;
    border:none;
    border-radius: 10px;
    background: linear-gradient(150deg, #fcfcfc, #fcfcfc);
    box-shadow:  5px 5px 10px #bdbdbd,
                -3px -3px 10px #f5f5f5;
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
