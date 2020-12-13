<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <span class="navbar-brand">
        <router-link :to="{name: 'home'}" style=" text-decoration: none; color: #000">
          <strong>Video4You</strong>
        </router-link>
      </span>
      <ul class="navbar-nav ml-auto" v-if="isLoggedIn">
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'upload' }">
            <b>Upload</b>
          </router-link>
        </li>
        <li class="nav-item">
          <div class="nav-link">
            <b>{{name}}</b>
          </div>
        </li>
        <li class="nav-item" @click="logout">
          <div class="nav-link">
            <b>Logout</b>
          </div>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto" v-if="!isLoggedIn">
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'login' }">
            <b>Login</b>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'register' }">
            <b>Register</b>
          </router-link>
        </li>
      </ul>
    </nav>
    <hr />
  </div>
</template>

<script>
export default {
  props: ["isLoggedIn"],
  data() {
    return {
      check: false,
      name: ""
    };
  },
  mounted() {
    if (this.isLoggedIn) {
      let user = JSON.parse(localStorage.getItem("Video4You.user"));
      this.name = user.name;
    }
  },
  methods: {
    logout() {
      localStorage.removeItem("Video4You.user");
      localStorage.removeItem("Video4You.jwt");
      this.$emit("logout");

      this.$router.replace(this.$route.query.redirect || "/");
    }
  }
};
</script>

<style>
</style>