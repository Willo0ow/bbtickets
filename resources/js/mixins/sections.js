
export default {

    computed: {
        sections () {
            if(this.user){
                return [
                    {label: 'Przegląd', code: 'all', path:'/'},
                    {label: 'Moje Zgłoszenia', code: 'user-tickets', path:`/tickets/${this.user.id}`},
                    {label: 'Nowy Ticket', code: 'new-ticket', path: '/ticket/new'},
                    {label: 'Zarządzanie', code: 'manage', path: `/tickets/manage/${this.user.department}`}
                ]
            }
        }

    },
    methods:{
        redirectTo(path){
            console.log(path);
            if(this.$route.path === path){
                console.log(`You're already at the requested loaction.`);
            } else {
                this.$router.push(path)
            }
        }
    },
}