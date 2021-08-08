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
            Terceros
        </v-tab>
        <v-tab>
            <v-icon left small>
                mdi-account-multiple-outline
            </v-icon>
            Otros Bancos
        </v-tab>

        <v-tab-item>
            <v-form ref="formEditProfile">

                <v-row class="ma-1">

                    <v-col cols="12" md="12">
                        <span class="name">Indica la cuentas</span>
                    </v-col>
                    <!-- Pais -->
                    <v-col cols="12" md="6">
                        <v-autocomplete filled dense placeholder="Cuenta Origen" :items="account" item-text="name" item-value="id" return-object @input="getAccount()" v-model="formAccountOwn.origen" :rules="rules.accountown.origen">
                        </v-autocomplete>
                    </v-col>
                    <!-- Pais -->
                    <v-col cols="12" md="6">
                        <v-autocomplete filled dense placeholder="Cuenta Destino" :items="account" item-text="name" item-value="id" return-object @input="getAccount()" v-model="formAccountOwn.destino" :rules="rules.accountown.destino">
                        </v-autocomplete>
                    </v-col>

                    <v-col md="6" cols="12">
                        <v-text-field v-model="formAccountOwn.montoFormat" placeholder="Monto a tranferir" @keypress="isNumberKey($event)" @blur="formatCost($event, index)" filled dense>
                        </v-text-field>
                    </v-col>

                    <v-col md="6" offset="3" cols="12" class="text-center">
                        <v-btn color="green" dark block>
                            tranferir
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
        <v-tab-item>
            <v-card flat>
                <v-card-text>
                    <p>
                        Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget,
                        vestibulum et, tempor auctor, justo.
                    </p>

                    <p class="mb-0">
                        Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum
                        sagittis.
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
            account: [],
            formAccountOwn: {
                monto: null,
                montoFormat: null,
                origen: null,
                destino: null,
            },
            rules: {
                accountown: {
                    monto: [(v) => !!v || "Monto es requerida."],
                    origen: [(v) => !!v || "Cuenta de origen es requerida."],
                    destino: [(v) => !!v || "Cuenta de destino es requerida."],
                }
            }
        }
    },
    mounted() {
        console.log('Component transaDcciones.')
        this.getAccount();
    },
    methods: {
        getAccount() {
            axios.get('/api/accountlist',
                    // {
                    //     params: {
                    //       user_id: document.querySelector("meta[name='user-id']").getAttribute('content'),
                    //     }
                    // }
                )
                .then((response) => {
                    console.log(response);
                    this.account = response.data.data;
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
        formatCost(e, i) {
            this.form.plans[i].costFormat = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP'
            }).format(e.target.value);
            this.form.plans[i].cost = e.target.value;
        },
    }
}
</script>
