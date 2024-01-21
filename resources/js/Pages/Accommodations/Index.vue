<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ListContracts from "@/Components/ListContracts.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from 'vue'
const props = defineProps({
    accommodations: {
        type: Object,
        default: () => ({}),
    } ,
    user: {
        type: Object,
        default: () => ({}),
    }
});
const form = useForm({});
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route("accommodations.destroy", id));
    }
}
const showModal = ref(false)
const displayModal = ref(false)
const listContracts = ref(false)
</script>

<template>
    <Head title="accommodations" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                accommodations Index
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-2">
                            <Link :href="route('accommodations.create')">
                            <PrimaryButton>Add accommodation</PrimaryButton>
                            </Link>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Standard Rack Rate
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            AvailableUnits
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Edit
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Delete
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Book
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Add Contract
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Contracts
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="accommodation in accommodations" :key="accommodation.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ accommodation.id }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ accommodation.name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ accommodation.description }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ accommodation.standard_rack_rate }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ accommodation.available_units }}
                                        </th>

                                        <td class="px-6 py-4">
                                            <Link :href="route('accommodations.edit', accommodation.id)
                                                " class="px-4 py-2 text-white bg-blue-600 rounded-lg">Edit</Link>
                                        </td>
                                        <td class="px-6 py-4">
                                            <PrimaryButton class="bg-red-700" @click="destroy(accommodation.id)">
                                                Delete
                                            </PrimaryButton>
                                        </td>
                                        <td class="px-6 py-4">
                                        <Link 
                                            :href="route('bookings.create', {id: accommodation.id})" 
                                            class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                                            Book
                                        </Link>
                                        </td>
                                        <td class="px-6 py-4">
                                            <PrimaryButton class="bg-gray-500" id="show-modal" >
                                                <Link 
                                                :href="route('contracts.create', {id: accommodation.id})" 
                                                class="px-4 py-2 text-white bg-blue-600 rounded-lg">Create
                                                </Link>
                                            </PrimaryButton>       
                                        </td>
                                             <td class="px-6 py-4">
                                                <ListContracts :accommodationId="accommodation.id" ></ListContracts>
                                        </td>  
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>