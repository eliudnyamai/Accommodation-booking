<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";


const props = defineProps({
    accommodation: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({
    name: props.accommodation.name,
    description: props.accommodation.description,
    standardrackrate: props.accommodation.standard_rack_rate,
    unitsAvailable:(props.accommodation.available_units).toString()
});

const submit = () => {
    form.put(route("accommodations.update", props.accommodation.id));
};
</script>

<template>
    <Head title="accommodation Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                accommodation Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput 
                                    id="name" 
                                    type="text"
                                    class="mt-1 block w-full" 
                                    v-model="form.name" required
                                    />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div>
                                <InputLabel for="description" value="Description" />
                                <TextInput 
                                    id="description"
                                     type="text" 
                                     class="mt-1 block w-full" 
                                     v-model="form.description" 
                                     required
                                    />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div>
                                <InputLabel for="standardrackrate" value="Standard Rack rate" />
                                <TextInput
                                 id="standardrackrate"
                                 type="text" 
                                 class="mt-1 block w-full" 
                                 v-model="form.standardrackrate" required
                                />
                                <InputError class="mt-2" :message="form.errors.unitsAvailable" />
                            </div>
                            <div>
                                <InputLabel for="unitsAvailable" value="units Available" />
                                <TextInput
                                 id="unitsAvailable" 
                                 type="text"
                                 class="mt-1 block w-full"
                                 v-model="form.unitsAvailable" 
                                 required
                                />
                                <InputError class="mt-2" :message="form.errors.unitsAvailable" />
                            </div>
                            <PrimaryButton type="submit" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>