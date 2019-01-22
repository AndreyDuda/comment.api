<template>
    <div>
        <h2>Комментарии</h2>
        <form @submit.prevent="addComment" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" v-model="comment.user_name">
                <textarea class="form-control" placeholder="Text" v-model="comment.text"></textarea>
                <button type="submit" class="btn btn-light btn-block">Save</button>
            </div>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchComments(pagination.prev_page_url)">
                        Prev
                    </a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#">
                        Page {{ pagination.current_page}} of {{ [pagination.last_page]}}
                    </a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchComments(pagination.next_page_url)">
                        Next
                    </a>
                </li>
            </ul>
        </nav>
        <div class="card card-body mb-2" v-for="comment in comments" v-bind:key="comment.id">
            <h3>{{ comment.user_name}}</h3>
            <p>{{ comment.text}}</p>
            <hr>
            <button @click="editComment(comment)" class="btn btn-warning mb-2">Edit</button>
            <button @click="deleteComment(comment.id)" class="btn btn-danger">Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                comments: [],
                comment : {
                    id       : '',
                    parent_id: '',
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
            fetchComments(page_url) {
                let vm = this;
                page_url = page_url || '/api/comments';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res.data);
                        this.comments = res.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },
            deleteComment(id) {
                if (confirm('Are You Sure?')) {
                    fetch(`/api/comments/${id}`, {
                        method: 'delete'
                    })
                      .then(res => res.json())
                      .then(data => {
                          alert('Comment Removed');
                          this.fetchComments();
                      })
                      .catch(err => console.log(err));
                }
                console.log(`id - ${id}`)
            },
            addComment() {
                if (this.edit == false) {
                    //add
                    fetch('api/comments', {
                        method: 'post',
                        body: JSON.stringify(this.comment),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json)
                        .then(data => {
                            this.comment.text = '';
                            this.comment.user_name = '';
                            alert('Comment Added');
                            this.fetchComments();
                        })
                        .catch(err => console.log(err))
                } else {
                    //edit
                    fetch('api/comments', {
                        method: 'put',
                        body: JSON.stringify(this.comment),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                        .then(res => res.json)
                        .then(data => {
                            this.comment.id        = '';
                            this.comment.text      = '';
                            this.comment.user_name = '';
                            alert('Comment Updated');
                            this.fetchComments();
                        })
                        .catch(err => console.log(err))


                }
            },
            editComment(comment) {
                this.edit              = true;
                this.comment.id        = comment.id;
                this.comment.user_name = comment.user_name;
                this.comment.text      = comment.text;
            }
        }
    };
</script>

