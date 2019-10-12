<template>
  <div>
    <portal to="navActions">
      <button class="btn btn-outline-primary" @click.prevent="showFormTopic = true">Add</button>
    </portal>

    <div v-if="showFormTopic">
      <form actions="/topics" method="POST">
        <laravel-token></laravel-token>
        <div class="form-group">
          <label>Texto:</label>
          <textarea name="body" id="body" class="form-control" v-model="body"></textarea>
          <small class="form-text text-muted">{{ bodyLenght }} / 256</small>
        </div>
        <button class="btn btn-success">Guardar</button>
      </form>
    </div>
    <div>
      <topic v-for="topic in topics" :key="topic.id" :topic="topic"></topic>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    topics: {
      type: Array,
      required: true
    }
  },
  data: function () {
    return {
      body: '',
      showFormTopic: false
    }
  },
  methods: {
    
  },
  computed: {
    bodyLenght: function () {
      return this.body.length;
    },
  }
}
</script>
