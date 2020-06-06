<template>
  <header class="header">
    <div class="user-info">
      <div class="user-info-login">{{ username }}</div>
      <img
        :src="avatar"
        alt="Avatar"
        class="user-info-avatar"
        id="navbarDropdown"
        role="button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      />
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <router-link to="/perfil">
          <a class="dropdown-item">Perfil</a>
        </router-link>
        <a class="dropdown-item" href="#">Alterar Senha</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" @click="logout">Sair</a>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: "v-toolbar",
  props: ["avatar", "username"],
  methods: {
    logout() {
      this.$http.get("/api/auth/logout")
      .then((res) => {
        if(res.status) {
          this.$session.destroy()
          this.$router.replace("/login")
        }
      }).catch((err) => {
        console.log(err)
      })
    }
  },
};
</script>

<style>
.header {
  grid-area: header;
  background-image: radial-gradient(
    circle,
    #08182e,
    #0b1b31,
    #0e1e33,
    #112136,
    #142439
  );
  display: flex;
  padding: 10px;
  justify-content: flex-end;
  align-items: center;
}

.header .user-info {
  margin-right: 20px;
  height: 25px;
  padding: 10px;
}

.header .user-info {
  display: flex;
  align-items: center;
  background: #fff;
  width: auto;
  border-radius: 10px;
}

.header .user-info .user-info-login {
  font-size: 0.7rem;
  margin-right: 5px;
}

.header .user-info .user-info-avatar {
  vertical-align: middle;
  margin-left: 5px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
}

.dropdown-menu a {
  color: #000;
  text-decoration: none;
}

.dropdown-menu a:hover {
  color: #000;
  background-color: #ddd;
  text-decoration: none;
}
</style>