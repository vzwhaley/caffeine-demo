<template>
    <div id="app" class="container">
        <div class="row" style="background-color:#999;padding:10px;">
            <h2 class="text-center" style="padding:20px;font-weight:bold;">Caffeinated Drinks Application</h2>
        </div>

        <div class="row" style="background-color:#CCC;" v-if="!['login', 'register'].includes($route.name)">
            <router-link to="/my-drinks" class="nav-item nav-link" style="border-right: 2px solid #666;">My Drink List</router-link>
            <router-link to="/add-my-drink" class="nav-item nav-link" style="border-right: 2px solid #666;">Add My Drink</router-link>
            <router-link to="/" class="nav-item nav-link" style="border-right: 2px solid #666;">Master Drink List</router-link>
            <router-link to="/create" class="nav-item nav-link" style="border-right: 2px solid #666;">Create Drink</router-link>

        </div>
        <hr />
        <router-view> </router-view>
    </div>
</template>

<script>
export default {}
</script>
