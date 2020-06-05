<template>
  <div class="login-container">
    <div class="login-form">
      <div class="form-card">
        <div class="logo-container">
          <img src="../../assets/debis.jpeg" alt="Logo" class="logo" />
        </div>
        <div class="form-title">Entrar no sistema</div>
        <div class="form-body">
          <div class="form-group">
            <label for="email">E-mail:</label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control"
              placeholder="Digite seu login..."
              v-model="auth.email"
            />
          </div>
          <div class="form-group">
            <label for="password">Senha:</label>
            <input
              type="password"
              name="password"
              id="password"
              class="form-control"
              placeholder="Digite sua senha..."
              v-model="auth.password"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary btn-lg btn-block" v-on:click="enviar">Entrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      auth: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    enviar() {
      const dados = Object.assign(this.auth);
      if (dados.email && dados.password) {
        this.$http
          .post("/api/authenticate", dados)
          .then(res => {
            console.log(res.data)
            const {user, token} = res.data;
            if (user && token) {
              this.$session.start();
              this.$session.set("user", user);
              this.$session.set("token", token);

              this.$router.replace("/");
            }
          })
          .catch(err => {
            console.log(err);
          });
      } else {
        alert("Por favor preencha todos os dados");
      }
    }
  }
};
</script>

<style>
.login-container {
  height: 100vh;
  background:#08182e;
}

.login-form {
  height: 85%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.form-card {
  position: absolute;
  width: 400px;
  height: auto;
  background-color: #fff;
  border-radius: 6px;
  padding: 15px;
  box-shadow: 4px 0px 20px -10px rgba(0, 0, 0, 0.75);
}



.login-form .logo-container {
  position: relative;
  height: 110px;
  width: 110px;
  margin: 0 auto;
  border-radius: 50%;
  top: -50px;
  background: #fff;
}

.login-form .logo-container .logo {
  width: 100%;
  border-radius: 50%;
}

.login-form .form-title {
  text-align: center;
  color: lightslategray;
  font-weight: bold;
  font-size: 1.2rem;
  margin-top: -40px;
}

.login-form .form-body {
  padding: 20px;
  margin-bottom: 5px;
}
</style>
