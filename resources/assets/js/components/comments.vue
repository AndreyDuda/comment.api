<template>
    <div>
        <h2>Comments</h2>
    </div>
</template>

<script>
    export default {
        date() {
            return {
                comments: [],
                comment : {
                    id       : '',
                    user_name: '',
                    text     : ''
                },
                parent_id : '',
                pagination: {},
                edit      : false
            }
        },

        created() {
            this.fetchComments();
        },

        methods: {
            fetchComments() {
                fetch('api/comments')
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                    })
            }
        }
    }
</script>

