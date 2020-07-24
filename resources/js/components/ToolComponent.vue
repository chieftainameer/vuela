<template>
  <v-app>
    <v-navigation-drawer
      app
      clipped
      :color="color"
      dark
      absolute
      v-model="drawer"
      mini-variant
      mini-variant-width="80"
      expand-on-hover
    >
      <v-list nav>
        <v-list-item>
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/men/81.jpg" />
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>DigiDoc</v-list-item-title>
            <v-list-item-subtitle>Tour online doctor</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-list-item v-for="item in items" :key="item.title" link>
          <v-list-item-icon>
            <v-icon>{{item.icon}}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>{{item.title}}</v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar :color="color" app dark clipped-left>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Title</v-toolbar-title>
    </v-app-bar>
    <v-main class="ma-10">ello</v-main>
  </v-app>
</template>
<script>
export default {
  data: function () {
    return {
      drawer: true,
      color: "teal",
      items: [
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Photos", icon: "mdi-image" },
        { title: "About", icon: "mdi-help-box" },
      ],
    };
  },
};
</script>
<style scoped>
</style>