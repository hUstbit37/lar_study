<template>
  <div class="container">
    <div class="row justify-content-center">
      <div id="list-video2">
        <div v-for="(item, index) in list_video" :key="index">
          <video width="640px" controls="controls">
            <source :src="`upload/video/${item.video_name}`" type="video/mp4" />
          </video>

          <div id="video-desc">
            <div class="video-name">
              <h4>{{item.video_name}}</h4>
            </div>

            <div class="row" id="sub">
              <div class="col-md-8">
                <div class="media">
                  <div class="media-left media-middle" style="margin-right: 5px">
                    <a href="#">
                      <img
                        src="img/avatar-duc.png"
                        alt="avatar"
                        class="media-object"
                        width="60"
                        height="60"
                      />
                    </a>
                  </div>
                  <div class="media-body media-middle">
                    <div class="media-heading" style="font-size: 14px">
                      <a href="#" class>Channel</a>
                    </div>
                    <div role="group" aria-label="..." class="btn-group btn-group-sm">
                      <button class="btn btn-subscribe btn-danger">
                        <i class="fa fa-play">Subscribe</i>
                      </button>
                      <button disabled="disabled" class="btn btn-default">100000</button>
                    </div>
                  </div>
                </div>
                <hr />
                <!-- <i class="fa fa-share-alt" aria-hidden="true">Share</i> -->
              </div>
            </div>
          </div>

          <div class="comment-area">
            <div>
              <form id="form-comment" class="form-group" @submit.prevent="addComment(item.id)">
                <!-- <label>Comment</label> -->
                <textarea
                  class="comment-textarea"
                  v-model="comment.content[item.id]"
                  name="comment_content"
                  placeholder="Write comment.."
                ></textarea>

                <div class="text-right">
                  <button type="reset" class="btn btn-secondary">Cancer</button>
                  <button type="submit" class="btn btn-primary">Comment</button>
                </div>
              </form>
            </div>
            <!-- <hr /> -->
            <!-- <div v-if="isAddCmt==item.id" class="alert-primary">{{messCmtAdded}}</div> -->
            <div id="show-comment">
              <div class="media item-cmt" v-if="isAddCmt==item.id">
                <img src="img/avatar-duc.png" alt="avatar" class="mr-3 mt-3 rounded-circle" />
                <div class="media-body">
                  <div class="user-name">{{nameUserCmt}}</div>
                  <div class="cmt-content">{{cmtAdded.comment_content}}</div>
                  <div>
                    <i>{{moment(cmtAdded.created_at).fromNow()}}</i>
                  </div>
                  <hr />
                </div>
              </div>
            </div>

            <CommentPerVideo :id_video="item.id" :user_name="item.user.name"></CommentPerVideo>
          </div>

          <hr />
        </div>
      </div>
    </div>
    <!-- ................................................................................ -->
    <div id="list-video" v-if="false">
      <div class="unit-video" v-for="item in list_video" :key="item.id">
        <div class="video-name">
          <strong>{{item.video_name}}</strong>
        </div>

        <video width="640px" controls="controls">
          <source :src="`upload/video/${item.video_name}`" type="video/mp4" />
        </video>

        <div>
          <form id="form-comment" @submit.prevent="addComment(item.id)">
            <textarea
              class="comment-area"
              v-model="comment.content[item.id]"
              name="comment_content"
              placeholder="Write comment.."
            ></textarea>
            <br />
            <div id="a">
              <button type="submit" class="btn btn-primary">Comment</button>
            </div>
          </form>
        </div>
        <div v-if="isAddCmt==item.id" class="alert-primary">{{messCmtAdded}}</div>
        <div id="show-comment">
          <div class="media item-cmt" v-if="isAddCmt==item.id">
            <img src alt="avatar" class="mr-3 mt-3 rounded-circle" />
            <div class="media-body">
              <div class="user-name">{{ cmtAdded.id_user }}</div>
              <div class="cmt-content">{{cmtAdded.comment_content}}</div>
              <div>
                <i>{{cmtAdded.created_at}}</i>
              </div>
            </div>
          </div>

          <div v-for="(x, index) in item.comment" :key="index">
            <div class="media item-cmt">
              <img src alt="avatar" class="mr-3 mt-3 rounded-circle" />
              <div class="media-body">
                <div class="user-name">{{ x.id_user }}</div>
                <div class="cmt-content">{{x.comment_content}}</div>
                <div>
                  <i>{{x.created_at}}</i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
var moment = require("moment");
import CommentPerVideo from "./CommentPerVideo.vue";
export default {
  data() {
    return {
      isInputCmt: false,
      isAddCmt: null,
      cmtAdded: {},
      nameUserCmt: "",
      messCmtAdded: "",
      list_video: {},
      comment: {
        content: [],
        id: 0
      },
      moment: moment
    };
  },
  created() {
    this.getVideo();
  },
  methods: {
    getVideo() {
      axios.get("show.video").then(resp => {
        this.list_video = resp.data.listVideo;
      });
    },
    addComment(id) {
      this.comment.id = id;
      axios
        .post("add.comment/" + id, {
          comment_content: this.comment.content[id],
          id_video: this.comment.id
        })
        .then(response => {
          this.cmtAdded = response.data.unitCmt;
          this.messCmtAdded = response.data.mess;
          console.log(response.data.nameUserCmt);
          this.isAddCmt = id;
          this.nameUserCmt = response.data.nameUserCmt;
          this.comment.content[id] = "";
        });
    }
  },
  components: {
    CommentPerVideo
  }
};
</script>

<style lang="scss" scoped>
#list-video,
#list-video2 {
  width: 640px;
  #video-desc,
  .comment-area {
    background-color: white;
    box-sizing: border-box;
    border: 1px solid transparent;
    padding: 10px 0 10px 0;
    margin: 15px 0 20px 0;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.05);
  }
  .video-name {
    text-align: left;
    font-size: 18px;
  }
  .comment-textarea {
    width: 640px;
    margin-bottom: 5px;
  }
  textarea {
    display: block;
    width: 100%;
    border: 0;
    padding: 10px 5px;
    background: white no-repeat;

    background-image: linear-gradient(to bottom, #1abc9c, #1abc9c),
      linear-gradient(to bottom, silver, silver);

    background-size: 0 2px, 100% 1px;

    background-position: 50% 100%, 50% 100%;

    /* animation solely on background-size */
    transition: background-size 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
  }

  textarea:focus {
    background-size: 100% 2px, 100% 1px;
    outline: none;
  }

  .btn-primary {
    // color: red;
    // margin-bottom: 15px;
  }
}
#show-comment {
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