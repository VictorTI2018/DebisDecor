<template>
  <div class="container-perfil">
    <div class="col-md-4">
      <div class="container-avatar-perfil">
        <img :src="model.avatar" alt="avatar" class="avatar-perfil" />
      </div>
    </div>
    <div class="col-md-8">
      <div class="form" role="form">
        <v-page-title titulo="Atualizar Usuario"></v-page-title>
        <div class="col-md-12">
          <label for="username">Username:</label>
          <input type="text" class="form-control" v-model="model.username" />
        </div>
        <div class="col-md-12">
          <label for="email">E-mail:</label>
          <input type="email" class="form-control" v-model="model.email" />
        </div>
      </div>
      <div class="container-buttons">
        <div class="col-md-2">
          <button class="btn btn-danger btn-lg btn-block">
            <font-awesome-icon :icon="['fas', 'trash']" />
          </button>
        </div>
        <div class="col-md-2">
          <button class="btn btn-success btn-lg btn-block">
            <font-awesome-icon :icon="['fas', 'plus']" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "perfil",
  data() {
    return {
      model: {
        username: "",
        email: "",
        avatar: ''
      }
    };
  },
  methods: {
    getById(user_id) {
      this.$http
        .get(`/api/user/${user_id}`)
        .then(res => {
          this.model = Object.assign(res.data)
        })
        .catch(err => {
          console.log(err);
        });
    },
    handleSubmit() {
        const dados = Object.assign(this.model)
        if(dados.email && dados.username) {

        } else {
            alert("Por favor informe todos os dados")
        }
    }
  },
  mounted() {
    const user = this.$session.get("user");
    if (user && user.id > 0) {
      this.getById(user.id);
    }
  }
};
</script>

<style>
.container-perfil {
  display: flex;
  flex-direction: row;
}
.container-avatar-perfil {
  height: 100%;
  display: flex;
  justify-content: center;
}
.avatar-perfil {
  border-radius: 4px;
  height: 220px;
  width: 220px;
  box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
}
</style>