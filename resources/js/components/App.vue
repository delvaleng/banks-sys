<template>
<div id="app">
    <v-app light>

        <Navbar />
        <v-main style="padding-left:250px;" >
            <router-view></router-view>
        </v-main>
    </v-app>
</div>
</template>

<script>
import Navbar from './Navbar';

export default {
    name: 'App',

    components: {
        Navbar,
    },

    data: () => ({
        drawer: false,
    }),
    methods: {
        toggleLeftMenu() {
            if (this.rightMenu && this.leftMenu) {

                this.leftMenu = !this.leftMenu;
                this.rightMenu = false;
                this.$nextTick(() => {
                    var d = document.getElementById("nav2");
                    d.classList.add("hide");
                });
            } else if (!this.rightMenu && !this.leftMenu) {
                this.leftMenu = true;
            } else if (!this.rightMenu && this.leftMenu) {
                this.leftMenu = false;
                var d = document.getElementById("nav2");
                d.classList.add("hide");

            } else if (this.rightMenu && !this.leftMenu) {
                this.leftMenu = true;
                var d = document.getElementById("nav2");
                d.classList.remove("hide");
                // this.rightMenu = true;
            }


        }
    }
};
</script>
