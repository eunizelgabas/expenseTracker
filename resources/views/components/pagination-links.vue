<template>
    <div v-if="data.links.length > 3" class="flex justify-center mt-4 space-x-4">
        <Link
            v-for="(link, key) in data.links"
            :key="key"
            class="px-4 py-3 text-L leading-4 bg-purple-100 rounded hover:bg-purple-400 focus:text-gray-500 hover:shadow-sm"
            :class="{'bg-purple-400 text-dark': link.active}"
            :href="link.url"
            v-html="link.label"
        />
    </div>
</template>
<script setup>
import { Link }  from '@inertiajs/inertia-vue3';

defineProps({
    data:Object,
   
});
</script>