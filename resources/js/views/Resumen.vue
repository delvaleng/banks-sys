<template>
  <v-card height="100%" class="pa-4">
    <div class="panel-heading font-weight-black">Resumen</div>

    <v-card-title>
      <v-text-field
        dense
        v-model="search"
        append-icon="mdi-magnify"
        label="Búsqueda"
        single-line
        hide-details
      ></v-text-field>
      <v-spacer></v-spacer>
    </v-card-title>

    <template>
      <v-data-table
        dense
        :headers="headers"
        :search="search"
        :items="accounts"
        item-key="name"
        class="elevation-1"
      >
        <template v-slot:item.status="{ item }">
          <v-chip :color="getColor(item.status)" dark small center>
            {{ item.status == 1 ? "HABILITADA" : "INHABILITADA" }}
          </v-chip>
        </template>

        <template v-slot:item.balance="{ item }">
          {{ getFormat(item.balance) }}
        </template>

        <template v-slot:item.id="{ item }">
          <v-btn small text @click="getTransacciones(item.id)">
            <v-icon small>mdi-eye</v-icon>
            <span class="text-decoration-none text-caption">Ver</span>
          </v-btn>
        </template>
      </v-data-table>
    </template>
    <br />
    <v-divider></v-divider>
    <br />
    <div class="panel-heading font-weight-black">
      Detalles de las Transacciones
    </div>

    <v-card-title>
      <v-text-field
        dense
        v-model="search2"
        append-icon="mdi-magnify"
        label="Búsqueda"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>

    <template>
      <v-data-table
        dense
        :headers="headers2"
        :search="search2"
        :items="transacciones"
        item-key="name"
        class="elevation-1"
      >
        <template v-slot:item.mount_next="{ item }">
          {{ getFormat(item.mount_next) }}
        </template>
        <template v-slot:item.mount_prev="{ item }">
          {{ getFormat(item.mount_prev) }}
        </template>
        <template v-slot:item.mount="{ item }">
          {{ getFormat(item.mount) }}
        </template>
      </v-data-table>
    </template>
  </v-card>
</template>

<script>
export default {
  mounted() {
    this.token = document
      .querySelector("meta[name='user-token']")
      .getAttribute("content");
    this.getAccountList();
    this.getTransacciones();
  },
  methods: {
    getColor(status) {
      if (status == false) return "red";
      else return "green";
    },
    getFormat(balance) {
      return new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
      }).format(balance);
    },

    getAccountList() {
      axios({
        method: "get",
        url: "/api/account/me",
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
    getTransacciones(id) {
      this.transacciones = [];
      axios({
        method: "post",
        url: "/api/transfer/list",
        data: {
          id_account_own_origen: id,
        },
        headers: {
          Accept: "application/json",
          Authorization: "Bearer " + this.token,
        },
      })
        .then((response) => {
          this.transacciones = response.data.tranferOwn;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  data: () => ({
    token: null,

    accounts: [],
    transacciones: [],

    search: "",
    search2: "",

    headers: [
      {
        text: "N° de Cuenta",
        value: "n_account",
      },
      {
        text: "Tipo de Cuenta",
        value: "tp_account",
      },
      {
        text: "Tipo de Banco",
        value: "tp_banks",
      },
      {
        text: "Estatus",
        value: "status",
        align: "center",
      },
      {
        text: "Saldo",
        value: "balance",
        align: "right",
      },
      {
        text: "Transacciones",
        value: "id",
      },
    ],
    headers2: [
      {
        text: "N° Transaccion",
        value: "n_transfer",
      },
      {
        text: "Cta Origen",
        value: "n_account_origen",
      },
      {
        text: "Cta Destino",
        value: "n_account_destino",
      },
      {
        text: "Monto Previo",
        value: "mount_prev",
        align: "right",
      },
      {
        text: "Monto Tranferido",
        value: "mount",
        align: "right",
      },
      {
        text: "Saldo",
        value: "mount_next",
        align: "right",
      },
    ],
  }),
};
</script>
