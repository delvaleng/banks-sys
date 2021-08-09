<template>
  <div>
    <p align="justify" class="font-italic font-weight-bold pl-4">
      <br />
      Realiza transferencias a terceros de forma rápida y efectiva.
    </p>
    <v-form ref="formAccountOther">
      <v-row class="ma-1">
        <v-col cols="12" md="12">
          <v-alert :type="alert1.type" :value="alert" dense text>
            {{ alert1.msg }}
          </v-alert>
          <v-progress-linear
            v-show="alertProgress"
            indeterminate
            color="green"
          ></v-progress-linear>
        </v-col>

        <v-col cols="12" md="6">
          <v-select
            single-line
            dense
            placeholder="Cuenta Origen"
            label="Cuenta Origen"
            :items="accounts"
            item-text="n_account"
            item-value="id"
            return-object
            @input="getAccount()"
            v-model="formAccountOther.origen"
            :rules="rules.accountother.origen"
          >
          </v-select>
        </v-col>
        <v-col cols="12" md="6"> </v-col>
        <v-col cols="12" md="6">
          <v-select
            single-line
            dense
            placeholder="Cuenta Destino"
            label="Cuenta Destino"
            :items="accountsOther"
            item-text="n_account"
            item-value="id"
            return-object
            @input="getAccount()"
            v-model="formAccountOther.destino"
            :rules="rules.accountother.destino"
          >
          </v-select>
        </v-col>
        <v-col md="6" cols="12">
          <v-text-field
            v-model="formAccountOther.costFormat"
            :rules="rules.accountother.costFormat"
            label="Monto a tranferir"
            placeholder="Monto a tranferir"
            @keypress="isNumberKey($event)"
            @blur="formatCost($event)"
            dense
          >
          </v-text-field>
        </v-col>
        <v-col cols="12" md="6"> </v-col>
        <v-col md="4" offset="8" cols="12" class="text-center">
          <v-btn color="green" dark block @click="tranferir()">
            Tranferir
          </v-btn>
        </v-col>
      </v-row>
    </v-form>
  </div>
</template>
<script>
export default {
  name: "Other",
  components: {},
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
      accountsOther: [],
      formAccountOther: {
        cost: null,
        costFormat: null,
        origen: null,
        destino: null,
      },
      rules: {
        accountother: {
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
    this.getAccountOther();
  },
  methods: {
    getAccountOther() {
      axios({
        method: "get",
        url: "/api/account/other",
        data: {},
        headers: {
          Accept: "application/json",
          Authorization: "Bearer " + this.token,
        },
      })
        .then((response) => {
          this.accountsOther = response.data.account;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
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
      this.formAccountOther.costFormat = new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
      }).format(e.target.value);
      this.formAccountOther.cost = e.target.value;
    },
    tranferir() {
      this.alert = false;

      if (this.$refs.formAccountOther.validate()) {
        if (this.formAccountOther.cost <= 0) {
          this.formAccountOther.costFormat = null;
          this.formAccountOther.cost = null;
          this.alert = true;
          this.alert1.type = "error";
          this.alert1.msg = "El monto a transferir debe ser válido.";

          this.alertProgress = false;

          setTimeout(() => {
            this.alert = false;
          }, 5000);
        } else if (
          this.formAccountOther.cost > this.formAccountOther.origen.balance
        ) {
          this.formAccountOther.costFormat = null;
          this.formAccountOther.cost = null;
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
            url: "/api/transfer/create",
            data: this.formAccountOther,
            headers: {
              Accept: "application/json",
              Authorization: "Bearer " + this.token,
            },
          })
            .then((response) => {
              if (response.data) {
                if (response.data.status == true) {
                  this.getAccount();
                  this.$refs.formAccountOther.reset();
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
