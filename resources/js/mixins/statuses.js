
import axios from '../axios'
export default {
    data(){
        return {
            statuses: null
        }
    },
    methods:{
        async retrieveStatuses(){
            let res = await axios.get('/typestatuses/ticket')
            this.statuses = res.data
        }
    },
    async created(){
        await this.retrieveStatuses()
    }
}