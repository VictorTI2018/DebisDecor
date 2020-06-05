<template>
  <span>
    <div class="mb-3 mt-2" v-if="filter">
      <div class="row">
        <div class="form-group col-md-10">
          <input
            type="search"
            placeholder="Digite para buscar..."
            class="form-control"
            v-model="buscar"
          />
        </div>
        <div class="col-md-2">
          <router-link :to="link || '#'" class="btn btn-success btn-block">{{texto_link }}</router-link>
        </div>
      </div>
    </div>
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th class="ordemCol"  v-for="(colum, index) in columns" :key="index" v-on:click="ordenaColuna(index)">{{ colum.label }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in lista" :key="index">
          <td v-for="colum in columns" :key="colum.key">{{ item[colum.value] }}</td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-center align-items-center">
      <button
        class="btn btn-link"
        @click="reload(pagination.last_page_url)"
        :disabled="!pagination.last_page_url"
      >Previous</button>
      <span>Pag. {{pagination.from}} até {{pagination.to}}</span>
      <button
        class="btn btn-link"
        @click="reload(pagination.next_page_url)"
        :disabled="!pagination.next_page_url"
      >Next</button>
    </div>
  </span>
</template>

<script>
import { debounce } from "lodash";
export default {
  name: "v-data-table",
  props: [
    "columns",
    "link",
    "ordem",
    "ordem_col",
    "texto_link",
    "url",
    "filter"
  ],
  data() {
    return {
      values: [],
      buscar: "",
      pagination: {},
      ordemAux: this.ordem || "asc",
      ordemAuxCol: this.ordem_col || 0
    };
  },
  computed: {
    lista() {
      if(this.ordemAux === "asc") {
        this.values.sort((a,b) => {
          if(Object.valuesa(a)[this.ordemAuxCol] > Object.values(b)[this.ordemAuxCol]) { return 1 }
          if(Object.valuesa(a)[this.ordemAuxCol] < Object.values(b)[this.ordemAuxCol]) { return -1 }
          return 0;
        })
      } else {
        this.values.sort((a,b) => {
           if(Object.valuesa(a)[this.ordemAuxCol] < Object.values(b)[this.ordemAuxCol]) { return 1 }
          if(Object.valuesa(a)[this.ordemAuxCol] > Object.values(b)[this.ordemAuxCol]) { return -1 }
          return 0;
        })
      }
      if (this.buscar) {
        return this.values.filter(res => {
          res = Object.values(res);
          for (let i = 0; i < res.length; i++) {
            if (
              (res[i] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >=
              0
            ) {
              return true;
            }
          }
          return false;
        });
      }
      return this.values;
    }
  },
  methods: {
    setPagination(data) {
      this.pagination = {
        first_page_url: data.first_page_url,
        from: data.from,
        last_page: data.last_page,
        last_page_url: data.prev_page_url,
        next_page_url: data.next_page_url,
        per_page: data.per_page,
        to: data.to,
        total: data.total
      };
    },
    ordenaColuna(colum) {
      this.ordemAuxCol = colum
      if(this.ordemAux.toLowerCase() === "asc") {
        this.ordemAux = 'desc'
      } else {
        this.ordemAux = 'asc'
      }
    },
    reload: debounce(function(page) {
      let url = page ? `${page}` : `${this.url}`;
      this.$http
        .get(url)
        .then(res => {
          this.setPagination(res.data);
          this.values = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    }, 10)
  },
  mounted() {
    this.reload();
  }
};
</script>

<style>
.ordemCol {
  cursor: pointer;
}
</style>