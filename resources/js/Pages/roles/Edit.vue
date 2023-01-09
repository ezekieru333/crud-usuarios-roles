<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";

import { Inertia } from '@inertiajs/inertia';


const props = defineProps({
  permissions: Object,
  role: Object,
  rolePermissions: Object
});
const form = useForm({
  id: props.role.id,
  name: props.role.name,
  permissions: props.rolePermissions
});
const submit = () => {
  form.put(route('roles.update', props.role.id));
};

const perms = ref([]);
</script>

<template>
  <AppLayout title="Role">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
    </template>
    <template #body>
      <div class="p-6 bg-white border-b border-gray-200">
        <form @submit.prevent="submit">
          <div class="mb-6 max-w-md">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
            <input type="text" v-model="form.name" name="name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              placeholder="" />
            <div v-if="form.errors.name" class="text-sm text-red-600">
              {{ form.errors.name }}
            </div>
          </div>
          <div class="mb-6 max-w-md">
            <div v-for="permission in permissions">
              <input type="checkbox" :id="permission.name" :value="permission.name" v-model="form.permissions">
              <label :for="permission.name" class="block mb-2 text-sm font-medium text-gray-900">{{ permission.name }}</label>
            </div>
          </div>
          <button type="submit"
            class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
            :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
            Submit
          </button>
        </form>
      </div>
    </template>
  </AppLayout>
</template>