<template>
    <div class="container">
        <div class="card">
            <form method="POST" @submit.prevent="onSubmit">
                <div class="card-body">
                    <div class="form-group">
                        <input type="url" v-model="url" class="form-control" placeholder="Enter URL" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <transition name="fade">
                        <div class="alert alert-danger mt-3 mb-0" v-if="error">
                            {{ error }}
                        </div>
                        <div class="alert alert-success mt-3 mb-0" v-else-if="shortUrl">
                            <a :href="shortUrl" target="_blank">{{ shortUrl }}</a>
                        </div>
                    </transition>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            url: '',
            shortUrl: null,
            error: null,
        };
    },
    methods: {
        async onSubmit() {
            this.shortUrl = this.error = null;

            const { url } = this;
            try {
                const { data } = await axios.post('/api/lnk/register', { url });
                this.shortUrl = data.url;
            } catch (error) {
                this.error = error.message;
            }
        }
    }
};
</script>
