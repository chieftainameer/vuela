<template>
  <v-col>
    <v-alert type="error">Route accessed succesfully</v-alert>
    <v-data-table :headers="headers" :items="roles" sort_by="calories" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat white>
          <v-toolbar-title>CRUD Operations</v-toolbar-title>
          <v-divider vertical class="mx-4" inset></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on ,attrs}">
              <v-btn v-bind="attrs" v-on="on" color="primary" class="mb-2" dark>New Item</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{fillTitle}}</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.id" label="ID"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.created_at" label="Created At"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.updated_at" label="Updated At"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="populate">Reset</v-btn>
      </template>
    </v-data-table>
  </v-col>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      {
        text: "ID",
        align: "start",
        sortable: false,
        value: "id",
      },
      { text: "Name", value: "name" },
      { text: "Created At", value: "created_at" },
      { text: "Updated At", value: "updated_at" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    roles: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      name: "",
      created_at: "",
      updated_at: "",
    },
    defaultItem: {
      id: 0,
      name: "",
      created_at: "",
      updated_at: "",
    },
  }),
  computed: {
    fillTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  watch: {
    dialog(val) {
      val || this.close;
    },
  },
  created() {
    this.populate();
  },
  methods: {
    populate() {
      axios.get("/api/roles", {}).then((res) => {
        console.log(res.data.roles[0]);
        this.roles = res.data.roles;
      });
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.roles[this.editedIndex], this.editedItem);
      } else {
        this.roles.push(this.editedItem);
      }
      this.close();
    },
    editItem(item) {
      //alert(item.name);
      this.editedIndex = this.roles.indexOf(item);
      this.editedItem = Object.assign({}, item);
      console.log(this.editedItem);
      this.dialog = true;
    },
    deleteItem(item) {
      const index = this.roles.indexOf(item);
      confirm("Are you sure you want to delete the item?") &&
        this.roles.splice(index, 1);
    },
  },
};
</script>
<style scoped>
</style>