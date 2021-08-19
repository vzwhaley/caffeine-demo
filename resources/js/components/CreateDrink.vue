<template>
    <div>
        <h3 class="text-center">Create Caffeinated Drink</h3>
        <div class="alert alert-success" v-if="submitted">
            Caffeinated drink successfully created!
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addDrink">
                    <div class="form-group">
                        <label>Drink Name</label>
                        <input type="text" class="form-control" v-model="drink.name">
                        <div style="font-size: 14px;color:#F00;">{{ error_name }}</div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" class="form-control" v-model="drink.description"></textarea>
                        <div style="font-size: 14px;color:#F00;">{{ error_description }}</div>
                    </div>
                    <div class="form-group">
                        <label>Caffeine Total</label>
                        <input type="text" class="form-control" v-model="drink.caffeine_total">
                        <div style="font-size: 14px;color:#F00;">{{ error_caffeine_total }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Caffeinated Drink</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
window.$ = require('jquery');

export default {
    data() {
        return {
            CSRF_TOKEN: $('meta[name="csrf-token"]').attr('content'),
            drink: {},
            submitted: false,
            error_name: '',
            error_description: '',
            error_caffeine_total: ''
        }
    },
    methods: {
        addDrink() {
            this.error_name = ''
            this.error_description = ''
            this.error_caffeine_total = ''

            axios.post('/api/drinks/store', {
                _token: this.CSRF_TOKEN,
                name: this.drink.name,
                description: this.drink.description,
                caffeine_total: this.drink.caffeine_total,
            }, {
                    headers: {
                        "Authorization": 'Basic ' + this.CSRF_TOKEN,
                        "Content-Type": "application/json",
                        "cache-control": "no-cache"
                    },
            })
            .then(response => {
                this.submitted = true
                this.drink.name = ''
                this.drink.description = ''
                this.drink.caffeine_total = ''
            })
            .catch(error => {
                error.response.data.error.name !== undefined ?
                    this.error_name = error.response.data.error.name[0] :
                        this.error_name = ''
                error.response.data.error.description !== undefined ?
                    this.error_description = error.response.data.error.description[0] :
                        this.error_description = ''
                error.response.data.error.caffeine_total !== undefined ?
                    this.error_caffeine_total = error.response.data.error.caffeine_total[0] :
                        this.error_caffeine_total = ''
            });
        }
    }
}
</script>
