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
                    </video>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
        },

        mounted(){
            const element = this.$refs['video-player'];

            videojs(element, {
                fluid: true
            });

        },
        
    })
</script>
