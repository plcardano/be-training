<template>
    <app-layout title="VideoJs">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                VideoJs
            </h2>
        </template>

        <div class="py-12 p-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5" data-setup="{}">
                    <video controls preload="auto" ref="video-player" class="video-js">  
                        <source src="//vjs.zencdn.net/v/oceans.mp4" type="video/mp4">        
                        <!-- <source src="C:\laragon\www\be-training\public\videos\video1.mp4" type="video/mp4">         -->
                    </video>
                </div>
                <!-- <div class="col-md-3">
                    <div class="row">
                        <div v-for="video, index in videoLists" :key="index" class="col-12 mb-2 border p-1">
                            <div style="cursor: pointer;" v-on:click="changeUrl(index)" >
                                <video-player :url="video.url" :controls="video.controls" :autoplay="video.autoplay" />
                                <div>{{video.name}} <span v-if="selectedVideo == index"><small>(Selected)</small></span></div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import videojs from 'video.js'

    export default defineComponent({
        components: {
            AppLayout,
        },
        mounted(){
            const element = this.$refs['video-player'];

            videojs(element, {
                fluid: true
            });
        }
    })
</script>
