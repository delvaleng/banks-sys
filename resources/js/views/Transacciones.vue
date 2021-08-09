<template>
  <v-card height="100%">
    <v-tabs fixed-tabs>
      <v-tab>
        <v-icon left small> mdi-account </v-icon>
        Cuentas Propias
      </v-tab>
      <v-tab>
        <v-icon left small> mdi-account-group </v-icon>
        Cuentas de terceros
      </v-tab>
      <v-tab-item class="pa-4">
        <AccountOwn />
      </v-tab-item>

      <v-tab-item class="pa-4">
        <AccountOther />
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>
<script>
import AccountOwn from "../components/Account/Own";
import AccountOther from "../components/Account/Other";

export default {
  components: {
    AccountOwn,
    AccountOther,
  },
  data() {
    return {
      token: null,
      id: null,
      alert: false,
      alertProgress: false,
      alert1: {
        type: "warning",
        msg: null,
      },
      accounts: [],
      accountsOther: [],
      formAccountOwn: {
        cost: null,
        costFormat: null,
        origen: null,
        destino: null,
      },
      formAccountOwnOther: {
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
        },
        accountownother: {
          cost: [(v) => !!v || "Monto es requerido."],
          costFormat: [(v) => !!v || "Monto es requerido."],
          origen: [(v) => !!v || "Cuenta de origen es requerida."],
          destino: [(v) => !!v || "Cuenta de destino es requerida."],
        },
      },
    };
  },
  mounted() {
    this.token = document
      .querySelector("meta[name='user-token']")
      .getAttribute("content");
    this.getAccount();
  },
  methods: {
    getAccount() {
      axios({
        method: "get",
        url: "/api/account/get",
        data: {},
        headers: {
          Accept: "application/json",
          Authorization: "Bearer " + this.token,
        },
      })
        .then((response) => {
          this.accounts = response.data.account;
        })
        .catch(function (error) {
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
      this.formAccountOwn.costFormat = new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
      }).format(e.target.value);
      this.formAccountOwn.cost = e.target.value;
    },
    tranferir() {
      this.alert = false;

      if (this.$refs.formAccountOwn.validate()) {
        if (this.formAccountOwn.origen.id == this.formAccountOwn.destino.id) {
          this.formAccountOwn.destino = null;
          this.alert = true;
          this.alert1.type = "error";
          this.alert1.msg =
            "Las cuentas de origen y destino deben ser diferentes.";
          this.alertProgress = false;

          setTimeout(() => {
            this.alert = false;
          }, 5000);
        } else if (this.formAccountOwn.cost <= 0) {
          this.formAccountOwn.costFormat = null;
          this.formAccountOwn.cost = null;
          this.alert = true;
          this.alert1.type = "error";
          this.alert1.msg = "El monto a transferir debe ser válido.";

          this.alertProgress = false;

          setTimeout(() => {
            this.alert = false;
          }, 5000);
        } else if (
          this.formAccountOwn.cost > this.formAccountOwn.origen.balance
        ) {
          this.formAccountOwn.costFormat = null;
          this.formAccountOwn.cost = null;
          this.alert = true;
          this.alert1.type = "error";
          this.alert1.msg =
            "Su saldo es insuficiente para realizar esa operación.";

          this.alertProgress = false;

          setTimeout(() => {
            this.alert = false;
          }, 5000);
        } else {
          this.alertProgress = true;
          axios({
            method: "post",
            url: "/api/tranferOwn/create",
            data: this.formAccountOwn,
            headers: {
              Accept: "application/json",
              Authorization: "Bearer " + this.token,
            },
          })
            .then((response) => {
              if (response.data) {
                if (response.data.status == true) {
                  this.getAccount();
                  this.$refs.formAccountOwn.reset();
                }
                this.alert = true;
                this.alert1.type = response.data.status ? "success" : "error";
                this.alert1.msg = response.data.msg;
                this.alertProgress = false;

                setTimeout(() => {
                  this.alert = false;
                }, 10000);
              }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      }
    },
  },
};
</script>
