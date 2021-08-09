<template>
  <div id="app">
    <v-app light>
      <Navbar />
      <v-main style="padding-left: 250px">
        <router-view></router-view>
      </v-main>
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
