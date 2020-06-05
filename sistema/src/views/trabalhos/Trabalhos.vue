<template>
  <div>
    
    <v-data-table :url="'api/trabalhos/' + 1" :columns="columns" :filter="true" texto_link="Novo Trabalho" link="/add-trabalhos"></v-data-table>
  </div>
</template>

<script>
export default {
  name: "trabalhos",
  data() {
    return {
      columns: [
        { label: "Codigo", value: "id", key: 0 },
        { label: "Nome", value: "nome", key: 1 }
      ],
      buscar: ""
    };
  }
};
</script>

<style>
.table th {
  text-align: center;
}

.table td {
  text-align: center;
}
</style>