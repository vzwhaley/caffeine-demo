<template>
    <div>
        <div class="row" style="background-color:#2a9055;padding:10px;text-align: center;">
            <h2 class="text-center" style="padding:20px;font-weight:bold;">{{ user_name }} Drink List
            for {{ today | moment("dddd, MMMM Do, YYYY") }}</h2>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th style="width:33%;font-size:18px;font-weight:bold;">Drink Name</th>
                <th style="width:33%;font-size:18px;font-weight:bold;">Total Consumed</th>
                <th style="width:33%;font-size:18px;font-weight:bold;">Total Available</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user_consumed_drink in user_consumed_drinks">
                <td>{{ user_consumed_drink.name }}</td>
                <td style="">{{ user_consumed_drink.total_consumed }}</td>
                <td style="">{{ user_consumed_drink.total_available }}</td>
            </tr>
            </tbody>
        </table>
        <hr />
        <div class="row" style="background-color:#227dc7;padding:10px;text-align: center;">
            <h2 class="text-center" style="padding:20px;font-weight:bold;">{{ user_name }} All-Time Consumed Drink List </h2>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th style="width:25%;font-size:18px;font-weight:bold;">Drink Name</th>
                <th style="width:25%;font-size:18px;font-weight:bold;">Total Consumed</th>
                <th style="width:25%;font-size:18px;font-weight:bold;">Total Caffeine</th>
                <th style="width:25%;font-size:18px;font-weight:bold;">Date Consumed</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user_drink in user_drinks">
                <td>{{ user_drink.name }}</td>
                <td style="">{{ user_drink.total_consumed }}</td>
                <td style="">{{ user_drink.total_caffeine }}</td>
                <td>{{ user_drink.consumed_at | moment("MM-DD-YYYY") }}</td>
            </tr>
            </tbody>
        </table>
        <hr />
    </div>
</template>

<script>
let moment = require('moment');
export default {
    data() {
        return {
            CSRF_TOKEN: $('meta[name="csrf-token"]').attr('content'),
            user_name: $('meta[name="user-name"]').attr('content'),
            user_drinks: [],
            today: new Date(),
            total_caffeine_consumed: 0
        }
    },
    mounted() {
        this.getMyConsumedDrinks();
        this.getMyDrinks();
    },
    methods: {
        getMyConsumedDrinks() {
            this.axios
                .get('/api/drinks/get-my-consumed-drinks')
                .then(response => {
                    this.user_consumed_drinks = response.data;
                });
        },
        getMyDrinks() {
            this.axios
                .get('/api/drinks/get-my-drinks')
                .then(response => {
                    this.user_drinks = response.data;
                });
        },
    }
}
</script>
