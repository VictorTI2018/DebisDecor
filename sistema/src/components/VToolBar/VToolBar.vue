<template>
  <header class="header">
    <div class="user-info">
      <div class="user-info-login">{{ username }}</div>
      <img :src="avatar" alt="Avatar" class="user-info-avatar" />
    </div>
  </header>
</template>

<script>
export default {
  name: "v-toolbar",
  props: ["avatar", "username"]
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
</style>