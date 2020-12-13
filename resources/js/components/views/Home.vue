<template>
  <div>
    <div class="list-video">
      <div v-for="(item, index) in list" :key="index" class="unit-video">
        <div>
          <video width="300px" height="170px" controls="controls">
            <source :src="`upload/video/${item.video_name}`" type="video/mp4" />
          </video>
        </div>

        <div class="video-name" style="height:30px">
          <b>{{item.video_name}}</b>
        </div>
        <div>
          <hr />
          <div v-if="!isLoggedIn">
            {{item.user.name}}
            <button class="btn btn-danger btn-sm">Subscribe</button>
          </div>
          <div v-if="isLoggedIn">
            {{item.user.name}}
            <button
              v-if="id==item.user.id"
              class="btn btn-danger btn-sm disabled"
            >Subscribe</button>

            <button
              v-if="id!==item.user.id && !friendListId.includes(item.user.id)"
              class="btn btn-danger btn-sm"
              @click="sub(item.user.id)"
            >Subscribe</button>
            <button
              v-if="id!==item.user.id && friendListId.includes(item.user.id)"
              class="btn btn-secondary btn-sm"
              @click="sub(item.user.id)"
            >Subscribed</button>
          </div>
        </div>
        <br />
      </div>
      <br />
    </div>
    <button @click="videoPaganation()" class="btn btn-outline-primary">Load more video</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: {},
      isLoggedIn: localStorage.getItem("Video4You.jwt") != null,
      userInfo: null,
      id: null,
      friendListId: []
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
      }
      axios.post("api/show", { id: this.id }).then(response => {
        console.log(response);
        this.list = response.data.listVideo;
        this.friendListId = response.data.friendListId;
      });
    },
    // videoPaganation() {
    //   var page = 2;
    //   axios.get("api/show?page=" + page).then(response => {
    //     console.log(response.data.listVideo.data);
    //   });
    // },
    sub($friendId) {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("Video4You.user"));
        this.id = user.id;

        axios
          .post("api/sub", { user_id: this.id, friend_id: $friendId })
          .then(response => {
            // console.log(response.data.check);
            if (response.data.check) {
              alert("Ban vua huy theo doi kenh nay");
            } else {
              alert("Ban vua theo doi kenh");
            }
            this.showVideo();
          });
      } else {
        alert("Please Login to Sub");
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