<template>
  <div class="home">
    <v-toolbar :avatar="user.avatar" :username="user.username" />
    <aside class="aside">
      <div class="aside-toolbar">
        <img src="../assets/debis_logo1.png" alt="Logo" class="aside-toolbar-logo" />
      </div>
      <div class="topnav">
        <router-link replace v-for="(item, index) in menu" :to="item.to" :key="index">
          <div class="row-links">
            <div class="col-md-1">
              <font-awesome-icon class="icon" :icon="['fas', item.icon]" />
            </div>
            <div class="col-md-6">
              <span class="text">{{ item.text }}</span>
            </div>
          </div>
        </router-link>
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
  methods: {
    routerName(name) {
      const route = this.$router.resolve({ name }).route;
      return { to: route.path, text: route.meta.title };
    }
  },
  computed: {
    menu() {
      return [
        { icon: "hammer", ...this.routerName("trabalhos") },
        { icon: "user", ...this.routerName("perfil") }
      ];
    }
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
  grid-template-columns: 220px 1fr;
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

.row-links {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.row-links .icon {
  margin-right: 4px;
  font-size: 1.3rem;
}

.row-links .text {
  margin-left: 10px;
  font-size: 1.3rem;
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

.form {
  background-color: #fff;
  padding: 10px ;
  border-radius: 10px;
  box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
}
.container-buttons {
  margin-top: 15px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: flex-end;
}
</style>
