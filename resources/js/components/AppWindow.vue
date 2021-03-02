<template>
    <div class="card main-card" v-if="user">
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
            <div class="card-body scrollable-body">
                <div class="container sections-container">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from '../axios'
import sections from '../mixins/sections'
import statuses from '../mixins/statuses'
    export default {
        mixins: [sections, statuses],
        data(){
            return{
                search: '',
                user: null
            }
        },
        methods:{
            async retrieveUser(){
                let res = await axios.get('/userdata')
                this.user = res.data
            }
        },
        async created(){
            await this.retrieveUser()
            
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
    /* background-image:radial-gradient(rgb(77, 150, 179),rgba(44, 62, 80,1)) ; */
    /* background:linear-gradient(145deg, #97b4c0,#396374, #2c3e50); */
    background: linear-gradient(145deg, #f2f8f9, #f3f9fb);
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
.scrollable-body{
    overflow-y: scroll;
    height: 100%;
    max-height: 90vh;
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
    background:   #f9fcfd;
    box-shadow:  inset 3px 3px 3px #dde3e6, inset 0px -3px 3px #f2f5f9;
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
    height: 100%;
}

</style>
