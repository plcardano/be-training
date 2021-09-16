<template>
    <app-layout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <!-- Products table -->
        <div class="py-5 p-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="flex justify-between">
                        <jet-input type="text" class="block ml-2 mb-4 w-60" placeholder="Search Product..."/>
                        <jet-button class="mb-4">
                            Create Product
                        </jet-button>
                    </div>
                    
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Category
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="product in products" :key="product.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ product.name }}
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ product.category.name }}
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                {{ product.description }}
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                {{ product.date }}
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <pagination class="m-6" :links="product.links" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Pagination from '@/Components/Pagination.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetButton from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Pagination,
            JetInput,
            JetButton
        },
        props: {
            products: Object,
            filters: Object,
        },
        // setup(props) {
        //     const form = reactive({
        //         search: props.filters.search,
        //         page: props.filters.page,
        //     });

        //     watchEffect(() => {
        //         const query = pickBy(form);

        //         Inertia.replace(
        //             route("products.index", Object.keys(query).length ? query : {})
        //         );
        //     });
        // }
    })
</script>
