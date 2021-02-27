<template>
<div>
    <div class="row" v-for="(status, id) of $parent.statuses" :key="id">
        <div class="col">
            <div class="card section-card" :id="status.name">
                <div class="card-header">{{status.label}}</div>
                <div class="card-body">
                    <div class="card ticket-card" v-for="n in status.tickets" :key="n+'ticket'+id">
                        <div class="card-header">Temat</div>
                        <div class="card-body"></div>
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
                tickets: null
            }
        },
        methods:{
            async retrieveUserTickets(){
                let res = await axios.get(`/usertickets/${this.userId}`)
                this.tickets = res.data
            },
            assignUserId(){
                this.userId = this.$route.params.user
            }
        },
        async created(){
            this.assignUserId()
            await this.retrieveUserTickets()
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
