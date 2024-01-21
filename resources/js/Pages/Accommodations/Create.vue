<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    accommodations: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: "",
    description: "",
    standardrackrate: "",
    availableUnits: ""
});

const submit = () => {
    form.post(route("accommodations.store"));
};
</script>

<template>
    <Head title="accommodation Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                accommodation Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div>
                                <InputLabel for="availableunits" value="AvailableUnits" />

                                <TextInput
                                    id="availableUnits"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.availableUnits"
                                    required
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.availableUnits"
                                />
                            </div>

                            <div class="my-6">
                                <label
                                    for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Description</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.description"
                                    name="description"
                                    id="description"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.description"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </div>
                            </div>
                            <div class="my-6">
                                <label
                                    for="standardrackrate"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Standardrackrate</label
                                >
                                <textarea
                                    type="text"
                                    v-model="form.standardrackrate"
                                    name="standardrackrate"
                                    id="standardrackrate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                ></textarea>

                                <div
                                    v-if="form.errors.standardrackrate"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.standardrackrate }}
                                </div>
                            </div>
                            <PrimaryButton
                                type="submit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Submit
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>