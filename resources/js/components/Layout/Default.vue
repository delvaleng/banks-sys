<template>
  <v-card height="350px">
    <v-navigation-drawer
      absolute
      permanent
      left
      fluid
    >
      <v-list dense>
        <v-list-item
          v-for="item in items"
          :key="item.title"
        >
          <v-list-item-icon>
            <v-icon small>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
  export default {
    name: 'main',
    data () {
      return {
        items: [
          { title: 'Estado de la Cuenta', icon: 'mdi-account-details-outline' },
          { title: 'Transacciones Bancarias', icon: 'mdi-account-cash' },
        ],
      }
    },
  }
</script>
