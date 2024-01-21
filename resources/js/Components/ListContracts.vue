<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
const props = defineProps(['show', 'accommodationId']);

const accommodationId = ref(props.accommodationId);
const contracts = ref([]);

const fetchContracts = async (accommodationId) => {
  try {
    const response = await axios.get(`/api/accommodations/${accommodationId}/contracts`);
    contracts.value = response.data;
    console.log(response);
  } catch (error) {
    console.error('Error fetching contracts:', error);
  }
};

onMounted(() => {
  fetchContracts(accommodationId.value);
});

const closeModal = () => {
  // If needed, you can emit an event or perform other actions to close the modal
  // $emit('close');
  // For simplicity, let's just log a message here
  console.log('Modal closed');
};

</script>

<template>
  
   

    <div class=" border-gray-200">
      <div v-for="contract in contracts" :key="contract.id" class="flex justify-between -mx-4 px-4 py-2">
        <div class="flex items-center">
          <span class="text-gray-900 dark:text-white whitespace-nowrap">
            Pay {{ contract.contract_rates }} Ksh &nbsp;
          </span>
        </div>
        <div class="flex items-center">
          <span class="text-gray-900 dark:text-white whitespace-nowrap">
               If You book {{ contract.volume_needed }} Units &nbsp;
          </span>
        </div>
        <div class="flex items-center">
          <span class="text-gray-900 dark:text-white whitespace-nowrap">
            from {{ contract.start_date }} to {{ contract.end_date }}
          </span>
        </div>
      </div>
    </div>
  
</template>


<style>
/* Your styling remains the same */
</style>
