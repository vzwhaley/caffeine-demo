<template>
    <div>
        <div class="row" style="background-color:#999;padding:10px;text-align: center;">
            <h2 class="text-center" style="padding:20px;font-weight:bold;">Master Caffeinated Drinks List</h2>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Drink Name</th>
                <th>Description</th>
                <th>Caffeine Amount</th>
                <th><router-link :to="{name: 'create'}" class="btn btn-success">+ Create Drink</router-link></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="drink in drinks" :key="drink.id">
                <td>{{ drink.name }}</td>
                <td>{{ drink.description }}</td>
                <td>{{ drink.caffeine_total }} mg</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: drink.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteDrink(drink.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            drinks: []
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
        deleteDrink(id) {
            this.axios
                .post(`/api/drink/delete/` + id, {
                    _token: this.CSRF_TOKEN
                    },{
                        headers: {
                            "Authorization": 'Basic ' + this.CSRF_TOKEN,
                                "Content-Type": "application/json",
                                "cache-control": "no-cache"
                        },
                })
                .then(response => {
                    let i = this.drinks.map(data => data.id).indexOf(id);
                    this.drinks.splice(i, 1)
                });
        }
    }
}
</script>
