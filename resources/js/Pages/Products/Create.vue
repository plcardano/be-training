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
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                                <span v-if="errors.name">{{ errors.name }}</span>
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

                            <div class="mt-4">
                                <jet-label for="images" value="Images" />
                                <input multiple="multiple" enctype="multipart/form-data" name="images" type="file" @input="form.images = $event.target.files[0]" class="p-2 mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>

                            <!-- <div class="mt-4">
                                <jet-label for="images" value="Images" />
                                <file-selector v-model="files" ref="files" :accept="['image/png', 'image/jpeg']">
                                    <dialog-button class="mt-1 block w-full border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">Add images...</dialog-button>
                                    <div class="w-40">
                                        <img v-for="preview in previews" :key="preview" :src="preview" class="mb-4" />
                                    </div>
                                </file-selector>
                            </div> -->

                            <!-- <div class="mt-4">
                                <jet-label for="images" value="Images" />
                                <input type="file" ref="files" name="image" multiple @change="imageChange">
                            </div>

                            <div class="mt-4">
                                <p v-for="(image,index) in images" :key="index">{{ image.name }}</p>
                            </div> -->

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
    import { FileSelector, Dropzone, DialogButton } from 'vue3-file-selector'
    import { ref, watch } from 'vue';

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
            FileSelector,
            Dropzone,
            DialogButton,
        },
        props: {
            categories: Array,
            errors: Object
        },
        
        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    category_id: null,
                    description: null,
                    date: null,
                    images: [],
                }),
            }
        },

        methods: {
            // imageChange(e){
            //     let selectedFiles = e.target.files;

            //     if (!selectedFiles.length) {
            //         return false;
            //     }

            //     for (let i = 0; i < selectedFiles.length; i++) {
            //         this.images.push(selectedFiles[i]);                                      
            //     }
            // },
            store() {
                // for (let i = 0; i < this.images.length; i++) {
                //     this.form.append('pics[]', this.images[i]);                    
                // }

                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }

                this.form.post(this.route('products.store'), config)
            },
        }
    })
</script>
