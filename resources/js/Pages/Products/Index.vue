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
                        <div class="flex items-center">
                            <div class="flex w-full bg-white">
                                <jet-input class="relative w-full px-6 py-3 mb-4 rounded-r focus:ring" v-model="form.search" autocomplete="off" type="text" name="search" placeholder="Search…" />
                            </div>
                        
                            <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" @click="reset">Reset</button>
                        </div>
                        <jet-button type="button" class="mb-4">
                           <Link :href="route('products.create')">Create Product</Link>
                        </jet-button>
                    </div>
                    
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Category
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Date
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="product in products.data" :key="product.id">
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
                                                    <div v-if="product.description.legth<30" class="text-sm font-medium text-gray-900">
                                                        {{ product.description }}
                                                    </div>
                                                    <div v-else class="text-sm font-medium text-gray-900">
                                                        {{ product.description.substring(0,30)+"..." }}
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
                                                <Link :href="route('products.edit', product.id)" class="text-indigo-400 hover:text-indigo-900">Edit</Link>
                                                <!-- <Link :href="route('products.destroy', product.id)" type="button" class="text-red-400 hover:text-red-900 ml-4">Delete</Link> -->
                                                <!-- <form @submit="destroy()"> -->
                                                    <button class="text-red-400 hover:text-red-900 ml-4" type="button" @click="destroy(product.id)">Delete</button>
                                                <!-- </form> -->
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <pagination class="m-6" :links="products.links" />
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
    import Pagination from '@/Components/Pagination'
    import JetInput from '@/Jetstream/Input.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import throttle from 'lodash/throttle'
    import mapValues from 'lodash/mapValues'
    import pickBy from 'lodash/pickBy'
    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            AppLayout,
            Pagination,
            JetInput,
            JetButton,
            Link
        },
        props: {
            value: String,
            products: Object,
            filters: Object,
        },
        data() {
            return {
                form: {
                    search: this.filters.search,
                },
            }
        },
        watch: {
            form: {
                deep: true,
                handler: throttle(function() {
                    this.$inertia.get(this.route('products.index'), pickBy(this.form), { preserveState: true })
                }, 150),
            },
        },
        methods: {
            reset() {
                this.form = mapValues(this.form, () => null)
            },
            destroy(id) {
                if (confirm('Are you sure you want to delete this product?')) {
                    this.$inertia.delete(this.route('products.destroy', id))
                }
            }
        },
    })
</script>
