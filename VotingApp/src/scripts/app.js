let vm = new Vue({
    el: '.container',
    data: {
        choice: '',
        email: '',
        message: '',
        users: '',
        postMessage: '',
        countries: []
    },

    created: function(){
        this.loadQuote();
        this.allUsers();
        this.votingResult();
    },
    
    methods: {
        allUsers: function(){
            axios.get('classes/Users.php').then(function(response) {
                vm.users = response.data;
            }).catch(error => {
                console.log(error);
            });
        },

        vote: function(){
            axios({
                url: './classes/Process.php',
                method: 'POST',
                data: {
                    choice: this.choice,
                    email: this.email
                }
            }).then(response => {
                Swal.fire({
                position: 'top',
                icon: response.data.success,
                title: response.data.message,
                showConfirmButton: false,
                timer: 2000
                });
                setTimeout(() => {
                    this.votingResult();
                    this.allUsers();
                }, 2500);
                
            })
            .catch(error => console.log(error))
        },

        votingResult: function(){
            axios.get('./classes/Calculate.php')
            .then(response => this.countries = response.data.countries);
        },

        loadQuote: function(){
                    axios.get('https://ron-swanson-quotes.herokuapp.com/v2/quotes').
                    then(response => {
                    this.message = response.data[0];
                    });
        }
    }
});

const button = document.querySelector('#btn');
button.addEventListener('click', event => event.preventDefault());