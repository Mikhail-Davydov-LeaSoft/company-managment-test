<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "CompanyCreate",
    props: {
    },
    components: {
        BreezeAuthenticatedLayout,
        Head
    },
    data() {
        return {
            formData: {
                name: null,
                email: null,
                website: null,
            },
            logo: null,
            logoName: null,
        };
    },
    methods: {
        async createCompany() {
            let formData = new FormData()
            formData.append('logo', this.logo)

            _.each(this.formData, (value, key) => {
                formData.append(key, value)
            })

            await axios.post('/company', formData, {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substring(2)
                }
            }).then(response => {
                console.log(response)
                // window.location.href = "/company"
            });
        },
        logoUpload(event) {
            // console.log(event.target.files)
            this.logo = this.$refs.file.files[0]
            this.logoName = this.logo.name
            // this.company.logo = event.target.files[0];
        }
    }
}
</script>

<template>
    <Head title="Companies" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Company
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form class="company">
                            <input type="text" class="simple-field" placeholder="Name" v-model="formData.name" required>
                            <input type="email" class="simple-field" placeholder="Email" v-model="formData.email">
                            <input type="file" ref="file" class="simple-field" placeholder="Logo" v-on:change="logoUpload" multiple>
                            <input type="text" class="simple-field" placeholder="Website" v-model="formData.website">
                            <button type="button" @click="createCompany">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style>
button {
    border: 1px solid grey;
    border-radius: 15% 15%;
    margin-top: 15px;
    padding: 4px 8px
}
button.min {
    padding: 0 5px;
    margin-left: 15px;
    color: blue;

}
</style>
