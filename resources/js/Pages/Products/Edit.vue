<template>
    <app-layout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12 p-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="flex justify-between">
                        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                            Edit Product
                        </h1>
                        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }">
                            <Link :href="route('products.index')">
                                Back
                            </Link>
                        </jet-button>
                    </div>
                        <jet-validation-errors class="mb-4" />

                        <form @submit.prevent="update">
                            <div>
                                <jet-label for="name" value="Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" :error="form.errors.name" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="category" value="Category" />
                                <select v-model="form.category_id" :error="form.errors.category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option :value="null"></option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <jet-label for="description" value="Description" />
                                <textarea id="description" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.description" :error="form.errors.description" required autofocus autocomplete="description"></textarea>
                            </div>

                            <div class="mt-4">
                                <jet-label for="date" value="Update Date" />
                                <jet-input type="datetime-local" class="mt-1 block w-full" v-model="form.date" :error="form.errors.date" />
                            </div>

                            <div class="mt-4">
                                <jet-label for="images" value="Update Image" />
                                <input multiple name="images" type="file" @input="form.images = $event.target.files[0]" class="p-2 mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>

                            <div class="mt-4">
                                <jet-label for="imagePreview" value="Preview" />
                                <img height="300" width="300" :src="getImage()" alt="Product Image">
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </jet-button>
                                
                            </div>

                        </form>
                        <div class="flex justify-end mt-2">
                            <jet-button class="ml-4 hover:bg-red-400 bg-red-500" @click="destroy">
                                    Delete
                            </jet-button>
                        </div>
                        
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent ({
        components: {
            AppLayout,
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },
        props: {
            product: Object,
            categories: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.product.name,
                    category_id: this.product.category_id,
                    description: this.product.description,
                    date: this.product.date,
                    images: null
                })
            }
        },       
        methods: {
            getImage() {
                let image = this.product.images ? '/storage/'+ this.product.images : 'https://via.placeholder.com/200'
                return image
            },               
            update() {
                this.$inertia.post(this.route('products.update', {
                    product: this.product.id,
                    _method: 'put'
                }), this.form)
            },
            destroy() {
                if (confirm('Are you sure you want to delete this product?')) {
                    this.$inertia.delete(this.route('products.destroy', this.product.id))
                }                
            },
        }
    })
    
</script>
