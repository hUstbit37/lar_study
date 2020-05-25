<template>
  <div>
    <!-- <span>
      <b>{{cmt_count}} comments</b>
    </span>

    <hr />-->
    <div v-for="(item, index) in cmtPerVideo" :key="index">
      <div class="show-comment">
        <div class="media item-cmt">
          <img
            src="https://animationcritique.com/wp-content/uploads/2017/08/ac-avatar_02-pros-tad-360x360.png"
            alt="avatar"
            class="mr-3 mt-3 rounded-circle"
          />
          <div class="media-body">
            <div class="user-name">{{user_name}}</div>
            <div class="cmt-content">{{item.comment_content}}</div>
            <div>
              <i>{{moment(item.created_at).fromNow()}}</i>
            </div>
            <hr />
          </div>
        </div>
      </div>
    </div>
    <br />
    <div v-if="isFullCmt" class="text-center">No more comment</div>
    <div style="padding:5px 0 30px 0">
      <button
        v-if="!isFullCmt"
        class="btn btn-outline-primary btn-block"
        @click="cmtPaganation()"
      >Load comment</button>
    </div>
  </div>
</template>

<script>
var moment = require("moment");
export default {
  created() {
    this.cmtPaganation();
  },

  props: ["id_video", "user_name"],
  data() {
    return {
      moment: moment,
      cmtPerVideo: {},
      page: 2,
      isFullCmt: false,
      cmt_count: 0
    };
  },
  methods: {
    cmtPaganation() {
      axios
        .post("cmtPaganation/" + this.id_video, {
          id: this.id_video,
          page: this.page
        })
        .then(response => {
          console.log(response.data.cmt);
          this.cmtPerVideo = response.data.cmt;
          this.cmt_count = response.data.cmt_count;
          if (response.data.cmt.length == response.data.cmt_count) {
            this.isFullCmt = !this.isFullCmt;
          }
        });
      this.page += 1;
    }
  }
};
</script>

<style lang="scss" scoped>
.show-comment {
  .item-cmt {
    width: 640px;
    padding: 5px;
    font: Arial;
    .rounded-circle {
      width: 60px;
    }

    .user-name {
      font-size: 19px;
      font-weight: bold;
      color: blue;
    }
    .cmt-content {
      font-size: 16px;
    }
    i {
      font-size: 14px;
      color: #999;
    }
  }
}
</style>