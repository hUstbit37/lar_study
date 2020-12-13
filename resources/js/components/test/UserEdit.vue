<template>
  <div class="user-edit">
    <h1>User Edit</h1>
    <p>My age: {{userAge}}</p>
    <button @click="setAge">Change my age</button>
  </div>
</template>

<script>
export default {
  props: {
    userAge: Number
  },
  methods: {
    setAge() {
      this.userAge = 20;
      this.$emit("ageWasSet", this.userAge);
    }
  }
};
</script>

<style scoped>
.user-edit {
  border: 1px solid black;
  background-color: lightgreen;
}
</style>