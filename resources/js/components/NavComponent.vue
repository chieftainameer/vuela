<template>
  <v-app>
    <v-container fluid>
      <v-navigation-drawer
        :mini-variant="miniVariant"
        :expand-on-hover="expandOnHover"
        :color="color"
        v-model="drawer"
        absolute
        dark
      >
        <v-list nav class="py-0">
          <v-list-item two-line>
            <v-list-item-avatar>
              <img src="https://randomuser.me/api/portraits/men/81.jpg" />
            </v-list-item-avatar>
            <v-list-item-content>
              <v-list-item-title>CricBuzz</v-list-item-title>
              <v-list-item-subtitle>Cricket Fanatics</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item v-for="item in items" :key="item.title" link>
            <v-list-item-icon>
              <v-icon>{{item.icon}}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="mx-4">{{item.title}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </v-container>
  </v-app>
</template>
<script>
export default {
  data() {
    return {
      drawer: true,
      items: [
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Photos", icon: "mdi-image" },
        { title: "About", icon: "mdi-help-box" },
      ],
      color: "purple",
      miniVariant: true,
      expandOnHover: true,
    };
  },
};
</script>
<style scoped>
aside {
  width: 80px !important;
}
img {
  align-content: center;
  justify-content: center;
}
aside:hover {
  width: 256px !important;
}
</style>