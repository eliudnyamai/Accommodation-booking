<script setup>
const props = defineProps(['show', 'accommodationId', 'userId']);
import { Head, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from 'vue';
const accommodationId = ref(props.accommodationId);
const userId = ref(props.userId);
const form = useForm({
  units_booked: "",
  accommodationId: accommodationId,
  userId:userId,
  check_in_date: ""
});




onMounted(() => {
  // Additional setup logic if needed
});

const submit = () => {
    form.post(route("bookings.store"));
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

              <label for="accommodationId">Enter Units To Book:</label> <br>
              <input class="w-75" type="text" id="units_booked" v-model="form.units_booked" required/>
              <br>
              <label for="checkInDate">Check-in Date:</label><br>
             <input type="date" class="w-75" id="check_in_date" v-model="form.check_in_date" name="check_in_date" required>

            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <!-- Your form submission button goes here -->
              <div class="flex w-100 justify-space-between space-x-4">
                <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Book</button>
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