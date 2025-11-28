<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
    dogs: { type: Array, default: () => [] },
    liked: { type: Array, default: () => [] },
});

function toggleLike(dogId) {
    if (props.liked.includes(dogId)) {
        router.delete(`/dogs/${dogId}/unlike`, {
            preserveScroll: true,
        });
    } else {
        router.post(`/dogs/${dogId}/like`, {}, {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="mb-4 font-bold text-lg">Available Dog Breeds</h3>

                        <div v-if="dogs.length" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                            <div v-for="dog in dogs" :key="dog.id" class="border rounded p-4">
                                <img :src="dog.image_url" alt="dog breed" class="w-full h-48 object-cover mb-2 rounded" />
                                <h4 class="font-semibold text-center">{{ dog.breed }}</h4>
                                <button
                                    class="mt-2 w-full py-1 rounded text-white"
                                    :class="liked.includes(dog.id) ? 'bg-red-500' : 'bg-blue-500'"
                                    @click="toggleLike(dog.id)"
                                >
                                    {{ liked.includes(dog.id) ? 'Unlike' : 'Like' }}
                                </button>
                            </div>
                        </div>

                        <p v-else>No dogs available.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
