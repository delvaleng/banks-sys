<template>
<div class="container">
    <br />
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <div class="panel panel-default">

                <br />
                <br />

                <v-snackbar :timeout="-1" :value="true" absolute left shaped top color="success">
                    Hola, Bienvenido!!<br />
                    Recuerda que para activar tu cuenta debes comunicarte con
                    nosotros.!
                </v-snackbar>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {};
    },
    beforeMount() {
        // this.$store.dispatch("getToken")
    },
    mounted() {
        console.log("Component HOME.");
        this.getAccount();
    },
    computed: {},
    methods: {
        getAccount() {
            const token = document
                .querySelector("meta[name='user-token']")
                .getAttribute("content");
            const id = document
                .querySelector("meta[name='user-id']")
                .getAttribute("content");
            axios({
                    method: "get",
                    url: "/api/account/me",
                    data: {
                        id: id,
                    },
                    headers: {
                        Accept: "application/json",
                        Authorization: "Bearer " + token,
                    },
                })
                .then((response) => {
                    console.log(response);
                    this.account = response.data.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
    },
};
</script>
