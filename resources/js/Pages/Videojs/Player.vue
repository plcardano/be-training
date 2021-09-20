<template>
    <video controls preload="auto" ref="video-player" class="video-js vjs-big-play-centered">  
        <source src="https://hls.protone.media/redfield.m3u8" type="video/mp4">
        
    </video>                 
</template>

<script>
    import videojs from 'video.js' 

    export default {
    props: [
        'src'
    ],
    data(){
        return {
            player: null,
        }
    },
    mounted(){
       const element = this.$refs['video-player'];

       this.player = videojs(element, {
           fluid: true
       })
    }
}
</script>
