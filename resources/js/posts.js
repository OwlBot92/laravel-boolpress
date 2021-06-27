const { default: Axios } = require("axios")

var app = new Vue({
    el:'#root',

    data: {
        title: 'Posts from Api, powered by VUE',
        posts: [],
    },

    mehtods:{



    },

    mounted(){
        axios.get('http://127.0.0.1:8000/api/posts')
        .then(result => {
            this.posts = result.data.posts;
        })
    }
})