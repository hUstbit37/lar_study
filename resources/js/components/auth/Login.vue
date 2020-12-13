<template>
  <div>
    <form @submit.prevent="login">
      <label for>Mail</label>
      <input v-model="email" type="email" />
      <label for>Password</label>
      <input v-model="password" type="password" />
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    login() {
      axios
        .post("api/login", {
          email: this.email,
          password: this.password
        })
        .then(response => {
          console.log(response.data);
          localStorage.setItem(
            "Video4You.user",
            JSON.stringify(response.data.user)
          );
          localStorage.setItem("Video4You.jwt", response.data.token);
          if (localStorage.getItem("Video4You.jwt") != null) {
            this.$emit("loggedIn");
            console.log("added localStorage");
          }
          this.$router.replace(this.$route.query.redirect || "/");
          // this.$router.push("/");
        });
    }
  }
};
</script>

<style>
</style>