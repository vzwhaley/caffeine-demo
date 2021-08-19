<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mx-auto">
                <form v-on:submit.prevent="login">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

                    <div class="form-group">
                        <label for="email"> Email Address</label>
                        <input type="email" v-model="email" class="form-control" name="email" placeholder="Email Address">
                        <div style="font-size: 14px;color:#F00;">{{ error_email }}</div>
                    </div>

                    <div class="form-group">
                        <label for="password"> Password</label>
                        <input type="password" v-model="password" class="form-control" name="password" placeholder="Password">
                        <div style="font-size: 14px;color:#F00;">{{ error_password }}</div>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </div>

</template>


<script>
import axios from 'axios'

export default{
    data(){
        return {
            CSRF_TOKEN: $('meta[name="csrf-token"]').attr('content'),
            email: '',
            password: '',
            error_email: '',
            error_password: ''
        }
    },

    methods:{
        login() {
            axios.post('/api/login', {
                _token: this.CSRF_TOKEN,
                email:this.email,
                password:this.password,
            }, {
                headers: {
                    "Authorization": 'Basic ' + this.CSRF_TOKEN,
                    "Content-Type": "application/json",
                    "cache-control": "no-cache"
                }
            })
            .then((res) => {
                localStorage.setItem('usertoken', res.data.token)
                this.email = ''
                this.password = ''
                this.$router.push('/my-drinks')

            })
            .catch(error => {

                // console.log(error.response.data.errors.email)
                error.response.data.errors.email !== undefined ?
                    this.error_email = error.response.data.errors.email[0] :
                        this.error_email = ''
                error.response.data.errors.password !== undefined ?
                    this.error_password = error.response.data.errors.password[0] :
                        this.error_password = ''
            });
        },
    }
}
</script>
