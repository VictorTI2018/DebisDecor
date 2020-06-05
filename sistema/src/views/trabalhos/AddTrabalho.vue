<template>
  <span>
    <div role="form" class="form">
      <v-page-title titulo="Dados do Trabalho"></v-page-title>
      <div class="form-group col-md-12">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" v-model="model.nome" />
      </div>
      <div class="col-md-12">
        <label for="descricao">Descrição:</label>
        <ckeditor v-model="model.descricao"></ckeditor>
      </div>
      <div class="col-md-12 mt-2">
        <input type="file" multiple accept="image/*" @change="onFileChange" />
      </div>
      <div class="row mt-3 ml-1">
        <span v-for="(image, key) in model.trabalhos_fotos.fotos" :key="key">
          <div class="col-md-4">
            
            <img class="card-foto" :ref="'image'" />
            
          </div>
        </span>
      </div>
    </div>
    <div class="container-buttons">
      <div class="col-md-2">
        <button class="btn btn-danger btn-block">
          <font-awesome-icon :icon="['fas', 'trash']" />
        </button>
      </div>
      <div class="col-md-2">
        <button class="btn btn-success btn-block" v-on:click="handleSubmit">
          <font-awesome-icon :icon="['fas', 'plus']"  />
        </button>
      </div>
    </div>
  </span>
</template>
<script>
export default {
  name: "add-trabalho",
  data() {
    return {
      inputs: [],
      model: {
        user_id: 0,
        nome: "",
        descricao: "",
        trabalhos_fotos: {
          titulo: [{ titulo: ''}],
          fotos: []
        }
      }
    };
  },
  methods: {
    onFileChange(e) {
      let vm = this;
      var selectedFiles = e.target.files;
      for (let i = 0; i < selectedFiles.length; i++) {
        this.model.trabalhos_fotos.fotos.push(selectedFiles[i]);
      }

      for (let i = 0; i < this.model.trabalhos_fotos.fotos.length; i++) {
        let reader = new FileReader();
        reader.onload = e => {
          this.$refs.image[i].src = reader.result;
          this.model.trabalhos_fotos.fotos[i] = e.target.result
        };

        reader.readAsDataURL(this.model.trabalhos_fotos.fotos[i]);
      }
    },
    handleSubmit() {
      const dados = Object.assign(this.model);
      const user = this.$session.get("user");
      dados.user_id = user.id;
      this.$http
        .post("/api/trabalhos/register", dados)
        .then(res => {
          console.log(res);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>



<style>
.form {
  background-color: #fff;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
}
.row-fotos {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  flex-wrap: wrap;
}
.card-foto {
  height: 130px;
  width: 130px;
  border-radius: 15px;
  background: #fff;
  border: 0;
  box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
  outline: none;
}

.container-buttons {
  margin-top: 10px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: flex-end;
}
</style>