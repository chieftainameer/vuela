<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
                <!-- <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn :href="source" icon large target="_blank" v-on="on">
                      <v-icon>mdi-code-tags</v-icon>
                    </v-btn>
                  </template>
                  <span>Source</span>
                </v-tooltip>-->
              </v-toolbar>
              <v-progress-linear :active="loading" :indeterminate="loading" color="primary"></v-progress-linear>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="email"
                    name="email"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="email"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    v-model="password"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="login">Login</v-btn>
              </v-card-actions>
              <v-snackbar v-model="snackbar">
                {{ text }}
                <template v-slot:action="{ attrs }">
                  <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">Close</v-btn>
                </template>
              </v-snackbar>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      loading: false,
      snackbar: false,
      text: "",
    };
  },
  methods: {
    login: function () {
      // Add a request interceptor
      axios.interceptors.request.use(
        (config) => {
          // Do something before request is sent
          this.loading = true;
          return config;
        },
        (error) => {
          // Do something with request error
          this.loading = false;
          return Promise.reject(error);
        }
      );

      // Add a response interceptor
      axios.interceptors.response.use(
        (response) => {
          // Any status code that lie within the range of 2xx cause this function to trigger
          // Do something with response data
          this.loading = false;
          return response;
        },
        (error) => {
          // Any status codes that falls outside the range of 2xx cause this function to trigger
          // Do something with response error
          this.loading = false;
          return Promise.reject(error);
        }
      );
      axios
        .post("/api/login", { email: this.email, password: this.password })
        .then((res) => {
          console.dir(res);
          this.text = "Logged In Successfully";
          this.snackbar = true;
          localStorage.setItem("token", res.data.status);
          this.$router
            .push("/admin")
            .then((res) => console.log("Logged in"))
            .catch((err) => console.log(err));
        })
        .catch((err) => {
          console.dir(err);
          this.text = err.response.data.status;
          this.snackbar = true;
        });
    },
  },
};
</script>
<style scoped>
</style>