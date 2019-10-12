<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="follow in follows" :key="follow.id">
                <div class="row">
                    <div class="col-9">
                        {{ follow.name }} <small class="text-muted">last topic at: {{ follow.last_topic_date }}</small>
                    </div>
                    <div class="col-3 text-right">
                        <form :action="`/users/${user.id}/follow`" method="POST" v-if="follow.is_following == 0">
                            <laravel-token></laravel-token>
                            <input type="hidden" name="follow_id" :value="follow.id"/>
                            <button class="btn btn-outline-primary">Follow</button>
                        </form>
                        <form :action="`/users/${user.id}/follow`" method="POST" v-if="follow.is_following == 1">
                            <laravel-token></laravel-token>
                            <request-method method="DELETE"></request-method>
                            <input type="hidden" name="follow_id" :value="follow.id"/>
                            <button class="btn btn-outline-danger">Unfollow</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            follows: {
                type: Array,
                required: true
            }
        }
    }
</script>
