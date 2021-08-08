<template>
<v-app height="350px">
    <v-card height="100%">
        <v-navigation-drawer absolute permanent left>
            <v-list dense>
                <v-list-item v-for="item in items" :key="item.title" @click="item.method">
                    <v-list-item-icon>
                        <v-icon small>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-main style="background-color:#fafafa" >
        </v-main>
    </v-card>
</v-app>
</template>
<script>
export default {
    data() {
        return {
            routePath: null,// this.$route.name,
            items: [{
                    title: 'Estado de la Cuenta',
                    icon: 'mdi-account-details-outline',
                    method: () => this.resumenAccount()
                },
                {
                    title: 'Transacciones Bancarias',
                    icon: 'mdi-account-cash',
                    method: () => this.showTransaction()
                },
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
        resumenAccount() {
            alert("hola");
        },
        showTransaction() {
            alert("hola2");
        }
    }
}
</script>
