<template>
  <div class="container">
    <h1>User Component</h1>
    <p>I am {{name}}, I'm Sky Oh!yead</p>
    <p>My age: {{age}}</p>
    <button @click="changeName" class="btn btn-danger">Change My Name</button>
    <hr />
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <user-detail
          :customName="name"
          @nameWasReset="name=$event"
          :resetNameFn="resetNameParent"
          :userAge="age"
        ></user-detail>
      </div>
      <div class="col-xs-12 col-sm-6">
        <user-edit :userAge="age" @ageWasSet="age=$event"></user-edit>
      </div>
    </div>
    <button @click="testCmt">test</button>
  </div>
</template>

<script>
import UserDetail from "./UserDetail";
import UserEdit from "./UserEdit";
export default {
  data() {
    return {
      name: "Messi",
      age: 30,
      test: [1, 2, 3]
    };
  },
  created() {
    this.testCmt();
  },
  methods: {
    changeName() {
      this.name = "Xavi";
    },
    resetNameParent() {
      this.name = "Messi";
    },
    testCmt() {
      axios
        .post("cmtPaganation", {
          dataCmt: this.test
        })
        .then(response => {
          console.log(response.data);
        });
    }
  },
  components: {
    "user-detail": UserDetail,
    "user-edit": UserEdit
  }
};
</script>

<style scoped>
div {
  padding: 30px;
}
.container {
  text-align: center;
  border: 1px solid black;
  background-color: lightblue;
}
</style>