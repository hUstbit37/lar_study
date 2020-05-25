<template>
  <div class="user-detail">
    <h1>User Detail</h1>
    <p>My name is {{customName}}</p>
    <p>My reverse name is {{reverseName}}</p>
    <p>My age: {{userAge}}</p>
    <button @click="resetName" class="btn btn-primary">Reset</button>
    <button @click="resetNameFn" class="btn btn-primary">Reset From Parent</button>
  </div>
</template>

<script>
export default {
  //props dùng để truyền dữ liệu từ cmp cha sang con, và các cmp con truyền thông báo đến cmp cha qua các sự kiện
  // Biến 'name' trong User.vue sẽ dc truyền xuống thông qua biến 'customName'
  // required: true thì bắt buộc phải có dữ liệu truyền từ cha sang con, và dữ liệu đó dạng Object
  //Nếu k dùng required, thi co the set gt mac dinh cho bien bang default
  props: {
    customName: {
      type: Object,
      required: true
      //default: 'giá trị mặc định'
    },
    resetNameFn: Function,
    userAge: Number
  },
  data() {
    return {};
  },
  methods: {
    resetName() {
      this.customName = "Messi";
      this.$emit("nameWasReset", this.customName);
    }
  },
  computed: {
    reverseName() {
      return this.customName
        .split("")
        .reverse()
        .join("");
    }
  }
};
</script>

<style scoped>
.user-detail {
  border: 1px solid black;
  background-color: lightcoral;
}
</style>