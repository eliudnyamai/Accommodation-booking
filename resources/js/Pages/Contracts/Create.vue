<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";
const props = defineProps({
    accommodation: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({
    accommodationId: props.accommodation.id,
    contract_rate: "",
    start_date: "",
    end_date: "",
    volume_needed:""
});

const submit = () => {
    form.post(route("contracts.store"));
};
</script>

<template>
    <Head title="contract Create" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                contract Create
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="contract_rate" value="contract_rate" />
                                <TextInput 
                                    id="contract_rate" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    v-model="form.contract_rate" 
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.contract_rate" />
                            </div>
                            <div>
                                <InputLabel for="start_date" value="start_date" />
                                <TextInput 
                                    id="start_date" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    v-model="form.start_date" 
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.start_date" />
                            </div>
                            <div>
                                <InputLabel for="end_date" value="end_date" />
                                <TextInput 
                                    id="end_date" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    v-model="form.end_date" 
                                    required
                                 />
                                <InputError class="mt-2" :message="form.errors.end_date" />
                            </div>
                            <div>
                                <InputLabel for="volume_needed" value="volume_needed" />
                                <TextInput 
                                    id="volume_needed" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    v-model="form.volume_needed" 
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.volume_needed" />
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