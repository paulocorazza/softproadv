<template>
        <!-- Message. Default to the left -->
        <div class="direct-chat-msg" :class="right">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">{{ message.user.name }}</span>
                <span class="direct-chat-timestamp float-right">{{ message.datetime_br}}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img v-if="message.user.image" class="direct-chat-img" :src="message.user.url_image" :alt="message.user.name">
            <img v-else class="direct-chat-img" src="/assets/images/no-image.png" alt="usuário">

            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
               {{ message.message}}
            </div>
            <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->
</template>

<script>
export default {
    name: "ChatMessage",
    props: ['message'],

    computed: {
        right () {
            return  window.Laravel.user === this.message.user.uuid ? 'right' : ''
        }
    }
}
</script>

<style scoped>

</style>
