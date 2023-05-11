<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message.id">
            <div class="clearfix">
                <div class="header d-flex justify-content-between">
                    <strong>
                        {{ message.user.name }}
                    </strong>
                    {{  new Date(message.created_at).toLocaleString()  }}
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>
<script>
export default {
    props: {"messages" :Array},
};
</script>
