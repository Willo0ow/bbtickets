
export default {

    computed: {
        sections () {
            if(this.user){
                return [
                    {label: 'Wszystkie', code: 'all', path:'/'},
                    {label: 'Moje', code: 'user-tickets', path:`/tickets/${this.user.id}`},
                    {label: 'Nowy', code: 'new-ticket', path: '/ticket/new'}
                ]
            }
        }

    },
    methods:{
        redirectTo(path){
            if(this.$route.path === path){
                console.log(`You're already at the requested loaction.`);
            } else {
                this.$router.push(path)
            }
        }
    },
}