<template>
  <div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title">{{ topic.author.name }} <small class="text-muted">{{ topic.created_at }}</small></h5>
      <p class="card-text">{{ topic.body }}</p>
      <a href="#" 
        class="card-link" 
        @click.prevent="showComments = ! showComments"
      >
        Comments
      </a>
      <a href="#" 
        class="card-link"
        v-if="editable"
        @click.prevent=""
      >
        Edit
      </a>
      <a href="#"
        class="card-link"
        v-if="deletable"
        @click.prevent=""
      >
        Delete
      </a>
      <div class="card bg-light" v-if="showComments">
        <div class="card-body">
          <ul class="list-unstyled">
            <comment v-for="comment in topic.comments" 
              :key="comment.id" 
              :comment="comment"
              class="mb-3"
            ></comment>
          </ul>
          <form :action="`/topics/${topic.id}/comments`" method="POST" @submit.prevent="submit" ref="newCommentForm">
            <laravel-token></laravel-token>
            <div class="form-group">
              <label>New comment</label>
              <textarea name="body" class="form-control" v-model="newComment"></textarea>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    topic: {
      type: Object,
      required: true
    },
    full: {
      type: Boolean,
      default: false
    },
    commentable: {
      type: Boolean,
      default: true
    },
    editable: {
      type: Boolean,
      default: false
    },
    deletable: {
      type: Boolean,
      default: false
    },
  },
  data: function () {
    return {
      showComments: false,
      newComment: ''
    }
  },
  methods: {
    submit: function () {
      if (this.newComment.length > 0) {
        this.$refs['newCommentForm'].submit();
      }
    }
  }
}
</script>
