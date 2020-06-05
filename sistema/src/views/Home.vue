<template>
  <div class="home">
    <v-toolbar :avatar="user.avatar" :username="user.username" />
    <aside class="aside">
      <div class="aside-toolbar">
        <img src="../assets/debis_logo1.png" alt="Logo" class="aside-toolbar-logo">
      </div>
      <div class="topnav">
        <router-link to="/trabalhos">Trabalhos</router-link>
        <a href="#news">Contratos</a>
        <a href="#contact">Templates</a>
      </div>
    </aside>
    <main class="main">
      <router-view></router-view>
    </main>
    <footer class="footer"></footer>
  </div>
</template>

<script>
import VToolbar from "../components/VToolBar/VToolBar.vue";
export default {
  name: "Home",
  components: {
    VToolbar
  },
  data() {
    return {
      user: {}
    };
  },
  mounted() {
    this.user = this.$session.get("user");
  }
};
</script>

<style>
.home {
  height: 100vh;
  display: grid;
  grid-template-areas: "aside header" "aside main" "aside footer";
  grid-template-rows: 50px 1fr 70px;
  grid-template-columns: 245px 1fr;
}

.aside {
  grid-area: aside;
  background-image: radial-gradient(
    circle,
    #08182e,
    #0b1b31,
    #0e1e33,
    #112136,
    #142439
  );
}

.aside .aside-toolbar {
  height: 51px;
  border-bottom: 1px solid #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
}



.aside .topnav {
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.aside .topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.aside .topnav a:hover {
  background-color: #08182eb7;
}



.main {
  grid-area: main;
  height: calc(100vh - 120px);
  padding: 25px;
  background: #ddd;
  overflow-y: scroll;
}

.footer {
  grid-area: footer;
  background-image: radial-gradient(
    circle,
    #08182e,
    #0b1b31,
    #0e1e33,
    #112136,
    #142439
  );
}
</style>
