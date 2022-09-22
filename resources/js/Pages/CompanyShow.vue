<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "CompanyShow",
    props: {
        company: {
            type: Array,
        },
    },
    components: {
        BreezeAuthenticatedLayout,
        Head
    },
    data() {
        return {
        };
    },
    methods: {
    }
}
</script>

<template>
    <Head title="Company" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Company ID: {{company.id}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{company}}
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
