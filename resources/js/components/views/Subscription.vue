<template>
  <div class="list-video">
    <div v-for="(item, index) in list" :key="index" class="unit-video">
      <video width="300px" height="170px" controls="controls">
        <source :src="`upload/video/${item.video_name}`" type="video/mp4" />
        <source :src="`upload/video/${item.video_name}`" type="video/webm" />
      </video>
      <div class="video-name">
        <b>{{item.video_name}}</b>
      </div>
      <div class="time">
        <b>{{item.created_at}}</b>
      </div>
      <br />
    </div>
    {{list1}}
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: {},
      isLoggedIn: localStorage.getItem("Video4You.jwt") != null,
      userInfo: null,
      id: null
    };
  },
  created() {
    this.showVideo();
  },

  methods: {
    showVideo() {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("Video4You.user"));
        this.id = user.id;
        axios.post("api/getSub", { id: this.id }).then(response => {
          this.list = response.data.listVideo;
        });
      } else {
        var confirm1 = confirm("Please Login");
        if (confirm1) {
          this.$router.replace(this.$route.query.redirect || "/login");
        } else {
          this.$router.replace(this.$route.query.redirect || "/");
        }
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.list-video {
  display: flex;
  flex-wrap: wrap;
  .unit-video {
    margin: 10px;
    width: 300px;
  }
}
</style>