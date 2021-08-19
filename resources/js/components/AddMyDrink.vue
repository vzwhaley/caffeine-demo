<template>
    <div>
        <h3 class="text-center">Add My Caffeinated Drink</h3>
        <div class="alert alert-success" v-if="submitted">
            Caffeinated drink successfully added!
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addMyDrink">
                    <div class="form-group">
                        <label>Drink Name</label>
                        <div style="margin-bottom:5px;"></div>
                        <select class="custom-select" v-model="selected_drink">
                            <option value="" selected disabled>Choose A Drink</option>
                            <option v-for="drink in drinks" :value="drink.id">{{ drink.name }}</option>
                        </select>
                        <div style="font-size: 14px;color:#F00;">{{ error_name }}</div>

                        <div style="margin-bottom:25px;"></div>

                        <label for="">Choose Consumption Date</label>
                        <datepicker :bootstrap-styling="true"
                                    class=""
                                    format="yyyy-MM-dd"
                                    v-model="selected_date"
                        >
                        </datepicker>
                        <div style="font-size: 14px;color:#F00;">{{ error_date }}</div>

                        <div style="margin-bottom:25px;"></div>

                        <button type="submit" class="btn btn-primary">Add Your Caffeinated Drink</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
let moment = require('moment');
import axios from 'axios'
import Datepicker from 'vuejs-datepicker';
window.$ = require('jquery');

export default {
    name: 'AddMyDrink',
    components: {
        Datepicker
    },
    data() {
        return {
            CSRF_TOKEN: $('meta[name="csrf-token"]').attr('content'),
            drinks: [],
            submitted: false,
            error_name: '',
            error_date: '',
            selected_drink: '',
            selected_date: new Date()
        }
    },
    mounted() {
        this.getDrinks();
    },
    methods: {
        getDrinks() {
            this.axios
                .get('/api/drinks')
                .then(response => {
                    this.drinks = response.data;
                });
        },
        addMyDrink() {
            this.error_name = ''
            this.error_date = ''

            axios.post('/api/drink/add-my-drink', {
                _token: this.CSRF_TOKEN,
                drink_id: this.selected_drink,
                selected_date: moment(this.selected_date).format('YYYY-MM-DD')
            }, {
                    headers: {
                        "Authorization": 'Basic ' + this.CSRF_TOKEN,
                        "Content-Type": "application/json",
                        "cache-control": "no-cache"
                    },
            })
            .then(response => {
                this.submitted = true
            })
            .catch(error => {
                error.response.data.error.drink_id !== undefined ?
                    this.error_name = error.response.data.error.drink_id[0] :
                        this.error_name = ''
                error.response.data.error.selected_date !== undefined ?
                    this.error_date = error.response.data.error.selected_date[0] :
                        this.error_date = ''
            });
        }
    }
}
</script>
