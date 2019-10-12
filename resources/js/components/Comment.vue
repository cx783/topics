<template>
  <li class="media">
    <div class="media-body">
      <h6 class="text-primary">{{ comment.author.name }} <small class="text-muted">{{ comment.created_at }}</small></h6>
      {{ comment.body }}
    </div>
  </li>
</template>

<script>
export default {
  props: {
    comment: {
      type: Object,
      required: true
    }
  }
}
</script>
