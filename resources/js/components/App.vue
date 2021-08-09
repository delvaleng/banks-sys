<template>
<div id="app">
    <v-app light>
        <Navbar />
        <v-main style="padding-left: 250px">
            <router-view></router-view>
        </v-main>
        <template>
            <v-footer padless>
                <v-col class="text-center" cols="12">
                    {{ new Date().getFullYear() }} — <strong>Sistema de transacciones bancarias en línea</strong>
                </v-col>
            </v-footer>
</template>
    </v-app>
  </div>
</template>

<script>
import Navbar from "./Navbar";

export default {
    name: "App",
    components: {
        Navbar,
    },
};
</script>
