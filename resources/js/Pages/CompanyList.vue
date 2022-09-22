<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
    name: "CompanyList",
    props: {
        companies: {
            type: Array,
        },
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        LaravelVuePagination
    },
    data() {
        return {
            companiesData: this.companies
        };
    },
    methods: {
        removeCompany(company) {
            axios.delete('/company/'+company.id).then(response => {
                const index = this.companiesData.findIndex((obj) => obj.id === company.id);
                if (index > -1) {
                    this.companiesData.splice(index, 1);
                }
                // this.status = response.data.status;
            })
        },
        getResults(page = 1) {
            axios.get('companyPaginate?page=' + page)
                .then(response => {
                    this.companiesData = response.data;
                });
        }
    }
}
</script>

<template>
    <Head title="Companies" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Companies
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            <li style="margin-bottom: 15px;" v-for="(company, index) in companiesData.data">
                                {{company}}
                                <br/>
                                <a :href="route('company.edit', company.id)">Edit</a>
                                <button @click="removeCompany(company)">Remove</button>
                            </li>
                        </ul>
                        <LaravelVuePagination :data="companiesData" @pagination-change-page="getResults" />
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
    padding: 4px 8px;
    margin-left: 15px;
}
button.min {
    padding: 0 5px;
    margin-left: 15px;
    color: blue;

}
</style>
