<template>
<v-navigation-drawer absolute left fixed >
    <v-list dense>
        <v-list-item v-for="item in items" :key="item.title" :to="item.route">
            <v-list-item-icon>
                <v-icon small>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</v-navigation-drawer>
</template>
<script>
export default {
    name: "Navbar",
    data() {
        return {
            routePath: null, // this.$route.name,
            items: [{
                    title: 'Home',
                    icon: 'mdi-home',
                    route: '/'
                }, {
                    title: 'Estado de la Cuenta',
                    icon: 'mdi-account-details-outline',
                    route: 'resumen'
                },
                {
                    title: 'Transacciones Bancarias',
                    icon: 'mdi-account-cash',
                    route: 'transacciones'
                },
            ],
            icons: [
                'mdi-facebook',
                'mdi-twitter',
                'mdi-linkedin',
                'mdi-instagram',
            ],
        }
    },
    mounted() {
        console.log(this.$route);
    },
    created() {
        // axios.get('/notas').then(res => {
        //     this.notas = res.data;
        // })
    },
    methods: {
        // resumenAccount() {
        //     alert("hola");
        // },
        // showTransaction() {
        //     alert("hola2");
        // }
    }
}
</script>
