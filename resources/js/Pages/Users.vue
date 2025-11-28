<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    users: Array,
});
</script>

<template>
    <Head title="Users and Their Liked Dogs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Users & Their Liked Dogs
            </h2>
        </template>

        <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="user in users"
                    :key="user.id"
                    class="bg-white rounded-lg shadow-md p-6"
                >
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ user.name }}</h3>
                    <p class="text-sm text-gray-500 mb-4">{{ user.email }}</p>

                    <div v-if="user.liked_dogs.length">
                        <h4 class="font-semibold text-gray-700 mb-2">Liked Dogs:</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div
                                v-for="dog in user.liked_dogs"
                                :key="dog.id"
                                class="bg-gray-100 rounded-lg p-2 text-center"
                            >
                                <img
                                    :src="dog.image_url"
                                    alt="Dog image"
                                    class="w-full h-28 object-cover rounded mb-2"
                                />
                                <p class="text-sm font-medium text-gray-700">{{ dog.breed }}</p>
                            </div>
                        </div>
                    </div>

                    <div v-else class="text-gray-400 italic">
                        No liked dogs.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
