<template>
  <v-col>
    <v-alert type="error">Route accessed succesfully</v-alert>
    <v-data-table
      v-model="selected"
      :headers="headers"
      :items="desserts"
      item-key="name"
      show-select
      class="elevation-1"
    ></v-data-table>
    <v-btn color="primary" @click="showSome">Clicko</v-btn>
  </v-col>
</template>
<script>
export default {
  data() {
    return {
      singleSelect: false,
      selected: [],
      headers: [
        {
          text: "Dessert (100g serving)",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "Calories", value: "calories" },
        { text: "Fat (g)", value: "fat" },
        { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" },
      ],
      desserts: [
        {
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: "1%",
        },
        {
          name: "Ice cream sandwich",
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: "1%",
        },
        {
          name: "Eclair",
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: "7%",
        },
        {
          name: "Cupcake",
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
          iron: "8%",
        },
      ],
    };
  },
  methods: {
    showSome() {
      this.selected.forEach((element) => {
        alert(element.calories);
      });
    },
  },
  mounted() {},
};
</script>
<style scoped>
</style>