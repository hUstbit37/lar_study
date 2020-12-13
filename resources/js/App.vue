<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <router-link :to="{name: 'home'}" class="navbar-brand">Video 4 You</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto"></ul>
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
            <router-link :to="{ name: 'upload' }" class="nav-link" v-if="isLoggedIn">Upload</router-link>
            <li class="nav-link user-dashboard" v-if="isLoggedIn">{{name}}</li>
            <li class="nav-link" v-if="isLoggedIn" @click="logout">Logout</li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="text-center">
      <router-link :to="{name: 'home'}">
        <b>Home</b>
      </router-link>
      <router-link :to="{name: 'subscription'}">
        <b>Subscription</b>
      </router-link>
    </div>

    <div class="container">
      <router-view @loggedIn="change"></router-view>
    </div>
  </div>
</template>

<script>
import Header from "./components/layout/Header.vue";
export default {
  data() {
    return {
      name: "",
      isLoggedIn: localStorage.getItem("Video4You.jwt") != null
    };
  },
  mounted() {
    this.setDefaults();
  },
  methods: {
    setDefaults() {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("Video4You.user"));
        this.name = user.name;
      }
    },
    change() {
      this.isLoggedIn = localStorage.getItem("Video4You.jwt") != null;
      this.setDefaults();
    },
    logout() {
      localStorage.removeItem("Video4You.user");
      localStorage.removeItem("Video4You.jwt");
      this.$router.replace(this.$route.query.redirect || "/");
      location.reload();
    }
  },

  components: {
    Header
  }
};
</script>

<style scoped>
.logout,
.user-dashboard {
  cursor: pointer;
}
</style>