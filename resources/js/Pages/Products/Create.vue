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
                            Create Product
                        </h1>
                        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }">
                            <Link :href="route('products.index')">
                                Back
                            </Link>
                        </jet-button>
                    </div>
                    
                        <jet-validation-errors class="mb-4" />

                        <form @submit.prevent="store">
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
                                <jet-label for="date" value="Date" />
                                <jet-input id="date" type="datetime-local" class="mt-1 block w-full" v-model="form.date" :error="form.errors.date" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save
                                </jet-button>
                            </div>
                        </form>
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

    export default defineComponent({
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
            categories: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    category_id: null,
                    description: null,
                    date: null,
                })
            }
        },

        methods: {
            store() {
                this.form.post(this.route('products.store'))
            },
        }
    })
</script>
