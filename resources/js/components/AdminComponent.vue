<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item v-for="item in items" :key="item.text" link :to="item.action">
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-subheader class="mt-4 grey--text text--darken-1">SUBSCRIPTIONS</v-subheader>
        <v-list>
          <v-list-item v-for="item in items2" :key="item.text" link>
            <v-list-item-avatar>
              <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt />
            </v-list-item-avatar>
            <v-list-item-title v-text="item.text"></v-list-item-title>
          </v-list-item>
        </v-list>
        <v-list-item>
          <v-list-item-title>
            <v-switch class="ml-3" v-model="theme" label="Switch Theme"></v-switch>
          </v-list-item-title>
        </v-list-item>
        <v-list-item class="mt-4" link>
          <v-list-item-action>
            <v-icon color="grey darken-1">mdi-plus-circle-outline</v-icon>
          </v-list-item-action>
          <v-list-item-title class="grey--text text--darken-1">Browse Channels</v-list-item-title>
        </v-list-item>
        <v-list-item link @click="logout">
          <v-list-item-action>
            <v-icon color="grey darken-1">mdi-cog</v-icon>
          </v-list-item-action>
          <v-list-item-title class="grey--text text--darken-1">Log out</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app clipped-left :color="navColor" dense>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-icon class="mx-4" large>mdi-youtube</v-icon>
      <v-toolbar-title class="mr-12 align-center">
        <span class="title">Youtube</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-row align="center" style="max-width: 650px">
        <v-text-field
          :append-icon-cb="() => {}"
          placeholder="Search..."
          single-line
          append-icon="mdi-magnify"
          color="white"
          hide-details
        ></v-text-field>
      </v-row>
    </v-app-bar>

    <v-main>
      <v-container class>
        <router-view></router-view>
        <v-row justify="center" align="center">
          <v-col class="shrink"></v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-snackbar v-model="snackbar">
      {{ text }}
      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">Close</v-btn>
      </template>
    </v-snackbar>
  </v-app>
</template>
<script>
export default {
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
    theme: true,
    navColor: "error",
    items: [
      { icon: "mdi-trending-up", text: "Users", action: "#" },
      { icon: "mdi-youtube-subscription", text: "Posts", action: "#" },
      { icon: "mdi-history", text: "Pages", action: "#" },
      { icon: "mdi-playlist-play", text: "Categories", action: "#" },
      { icon: "mdi-clock", text: "Roles", action: "/admin/roles" },
    ],
    items2: [
      { picture: 28, text: "Joseph" },
      { picture: 38, text: "Apple" },
      { picture: 48, text: "Xbox Ahoy" },
      { picture: 58, text: "Nokia" },
      { picture: 78, text: "MKBHD" },
    ],
  }),
  created() {
    this.$vuetify.theme.dark = true;
  },
  watch: {
    theme: function (old, newValue) {
      this.$vuetify.theme.dark = old;
      if (old == false) {
        this.navColor = "primary";
      } else {
        this.navColor = "error";
      }
    },
  },
  methods: {
    logout: function () {
      localStorage.removeItem("token");
      this.$router
        .push("/login")
        .then((res) => console.log("Logged out"))
        .catch((err) => console.log(err));
    },
  },
};
</script>
<style scoped>
</style>