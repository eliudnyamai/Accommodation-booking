<script setup>
const props = defineProps(['show', 'accommodationId']);
import { Head, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from 'vue';
const accommodationId = ref(props.accommodationId);
const form = useForm({
  start_date: "",
  end_date: "",
  contract_rate: "",
  accommodationId: accommodationId,
  volume_needed:""
});




onMounted(() => {
  // Additional setup logic if needed
});

const submit = () => {
    form.post(route("contracts.store"));
};


</script>

<template>
  <Transition name="modal">
    <div v-if="show" class="modal-mask" @click="$emit('close')">
      <div class="modal-container" @click.stop>
        <form @submit.prevent="submit">
          <div class="modal-header">
            <slot name="header">Default Header</slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              <!-- Your form fields go here -->
              <label for="accommodationId">Contract Rate</label> <br>
              <input class="w-75" type="text" id="contract_rate" v-model="form.contract_rate" required/>
              <br>
              <label for="checkInDate">Start Date:</label><br>
             <input type="date" class="w-75" id="start_date" v-model="form.start_date" name="check_in_date" required>
              <br>
               <label for="checkInDate">End Date:</label><br>
             <input type="date" class="w-75" id="end_date" v-model="form.end_date" name="check_in_date" required>
              <br>
              <label for="accommodationId">volume Needed</label> <br>
              <input class="w-75" type="text" id="volume_needed" v-model="form.volume_needed" required/>
              <br>
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <!-- Your form submission button goes here -->
              <div class="flex w-100 justify-space-between space-x-4">
                <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Create</button>
              <button class="modal-default-button" @click="$emit('close')">Cancel</button>
              </div>
            
            </slot>
          </div>
        </form>
      </div>
    </div>
  </Transition>
</template>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 1%;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  transition: opacity 0.3s ease;
}

.modal-container {
  width: 25%;
  margin: auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>