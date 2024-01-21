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
    user: {
        type: Object,
        default: () => ({}),
    }
});
const form = useForm({
    units_booked: "",
    check_in_date:"",
    accommodationId:props.accommodation.id,
    userId:props.user.id
});

const submit = () => {
    form.post(route("bookings.store"));
};
</script>

<template>
      <Head title="booking Create" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            booking Create
        </h2>
    </template>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="units_booked" value="units_booked" />
                            <TextInput 
                                id="units_booked" 
                                type="text" 
                                class="mt-1 block w-full"
                                v-model="form.units_booked"
                                required
                             />
                            <InputError class="mt-2" :message="form.errors.units_booked" />
                        </div>
                        <div>
                            <InputLabel for="check_in_date" value="check_in_date" />
                            <TextInput 
                                id="check_in_date" 
                                type="date" 
                                class="mt-1 block w-full" 
                                v-model="form.check_in_date"
                                required
                               />
                            <InputError class="mt-2" :message="form.errors.check_in_date" />
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