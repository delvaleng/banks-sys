<template>
<v-card height="100%">
    <v-tabs fixed-tabs>
        <v-tab>
            <v-icon left small>
                mdi-account
            </v-icon>
            Cuentas Propias
        </v-tab>
        <v-tab>
            <v-icon left small>
                mdi-account-group
            </v-icon>
            Cuentas a Terceros
        </v-tab>
        <v-tab-item class="pa-4">
            <p align="justify" class="font-italic font-weight-bold pl-4">
                <br>
                Realiza transferencias entre tus cuentas de forma rápida y efectiva.
            </p>
            <v-form ref="formAccountOwn">

                <v-row class="ma-1">
                    <v-col cols="12" md="12">
                        <v-alert :type="alert1.type" :value="alert" dense text>
                            {{ alert1.msg }}
                        </v-alert>
                        <v-progress-linear v-show="alertProgress" indeterminate color="green"></v-progress-linear>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-autocomplete dense placeholder="Cuenta Origen" label="Cuenta Origen" :items="accounts" item-text="n_account" item-value="id" return-object @input="getAccount()" v-model="formAccountOwn.origen"
                          :rules="rules.accountown.origen">
                        </v-autocomplete>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-autocomplete dense placeholder="Cuenta Destino" label="Cuenta Destino" :items="accounts" item-text="n_account" item-value="id" return-object @input="getAccount()" v-model="formAccountOwn.destino"
                          :rules="rules.accountown.destino">
                        </v-autocomplete>
                    </v-col>

                    <v-col md="6" cols="12">
                        <v-text-field v-model="formAccountOwn.costFormat" :rules="rules.accountown.costFormat" label="Monto a tranferir" placeholder="Monto a tranferir" @keypress="isNumberKey($event)" @blur="formatCost($event)" dense>
                        </v-text-field>
                    </v-col>

                    <v-col md="6" offset="3" cols="12" class="text-center">
                        <v-btn color="green" dark block @click="tranferir()">
                            Tranferir
                        </v-btn>
                    </v-col>
                </v-row>

            </v-form>

        </v-tab-item>

        <v-tab-item>
            <v-card flat>
                <v-card-text>
                    <p>
                        Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna
                        a orci. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Nunc sed turpis.
                    </p>

                    <p>
                        Suspendisse feugiat. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan
                        nisi mauris ac eros. In hac habitasse platea dictumst. Fusce ac felis sit amet ligula pharetra condimentum.
                    </p>

                    <p>
                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Nam commodo suscipit quam. In consectetuer turpis ut velit. Sed cursus turpis vitae tortor. Aliquam eu nunc.
                    </p>

                    <p>
                        Etiam ut purus mattis mauris sodales aliquam. Ut varius tincidunt libero. Aenean viverra rhoncus pede. Duis leo. Fusce fermentum odio nec arcu.
                    </p>

                    <p class="mb-0">
                        Donec venenatis vulputate lorem. Aenean viverra rhoncus pede. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Fusce commodo aliquam arcu. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi.
                    </p>
                </v-card-text>
            </v-card>
        </v-tab-item>
    </v-tabs>
</v-card>
</template>
<script>
export default {
    data() {
        return {
            token: null,
            id: null,
            alert: false,
            alertProgress: false,
            alert1: {
                type: 'warning',
                msg: null,
            },
            accounts: [],
            formAccountOwn: {
                cost: null,
                costFormat: null,
                origen: null,
                destino: null,
            },
            rules: {
                accountown: {
                    cost: [(v) => !!v || "Monto es requerido."],
                    costFormat: [(v) => !!v || "Monto es requerido."],
                    origen: [(v) => !!v || "Cuenta de origen es requerida."],
                    destino: [(v) => !!v || "Cuenta de destino es requerida."],
                }
            }
        }
    },
    mounted() {
        console.log('Component transaDcciones.')
        this.token = document.querySelector("meta[name='user-token']").getAttribute('content');
        this.id = document.querySelector("meta[name='user-id']").getAttribute('content');

        this.getAccount();
    },
    methods: {
        getAccount() {
            axios({
                    method: "get",
                    url: "/api/accountlist",
                    data: {},
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + this.token,
                    }
                })
                .then((response) => {
                    this.accounts = response.data.account;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        isNumberKey(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (
                charCode > 31 &&
                (charCode < 48 || charCode > 57) &&
                charCode !== 46
            ) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        formatCost(e) {
            this.formAccountOwn.costFormat = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP'
            }).format(e.target.value);
            this.formAccountOwn.cost = e.target.value;
        },
        tranferir() {
            this.alert = false

            console.log(this.formAccountOwn);


            if (this.$refs.formAccountOwn.validate()) {

                if (this.formAccountOwn.origen.id == this.formAccountOwn.destino.id) {
                    this.formAccountOwn.destino = null
                    this.alert = true
                    this.alert1.type = 'error'
                    this.alert1.msg = 'Las cuentas de origen y destino deben ser diferentes.';
                    this.alertProgress = false

                    setTimeout(() => {
                        this.alert = false
                    }, 5000)
                } else if (this.formAccountOwn.cost <= 0) {

                    this.formAccountOwn.costFormat = null
                    this.formAccountOwn.cost = null
                    this.alert = true
                    this.alert1.type = 'error'
                    this.alert1.msg = 'El monto a transferir debe ser válido.'

                    this.alertProgress = false

                    setTimeout(() => {
                        this.alert = false
                    }, 5000)
                } else if (this.formAccountOwn.cost > this.formAccountOwn.origen.balance) {

                    this.formAccountOwn.costFormat = null
                    this.formAccountOwn.cost = null
                    this.alert = true
                    this.alert1.type = 'error'
                    this.alert1.msg = 'Su saldo es insuficiente para realizar esa operación.'

                    this.alertProgress = false

                    setTimeout(() => {
                        this.alert = false
                    }, 5000)
                } else {
                    this.alertProgress = true
                    axios({
                            method: "post",
                            url: "/api/tranferOwn/create",
                            data: this.formAccountOwn,
                            headers: {
                                "Accept": "application/json",
                                "Authorization": "Bearer " + this.token,
                            }
                        })
                        .then((response) => {
                            console.log(response.data);
                            if (response.data) {
                                if (response.data.status == true) {
                                    this.getAccount();
                                    this.$refs.formAccountOwn.reset();

                                }
                                this.alert = true
                                this.alert1.type = (response.data.status) ? 'success' : 'error'
                                this.alert1.msg = response.data.msg;
                                this.alertProgress = false

                                setTimeout(() => {
                                    this.alert = false
                                }, 10000)
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }




            }
        }
    }
}
</script>
