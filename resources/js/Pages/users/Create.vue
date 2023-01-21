<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  roles: Object
});

const form = useForm({
  name: '',
  email: '',
  password: '',
  role: props.roles[0],

});

const submit = () => {
  form.post(route('users.store'));
};
</script>
<template>
  <AppLayout title="Users">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </template>
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
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
          <input type="text" v-model="form.email" name="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="" />
          <div v-if="form.errors.email" class="text-sm text-red-600">
            {{ form.errors.email }}
          </div>
        </div>
        <div class="mb-6 max-w-md">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
          <input type="password" v-model="form.password" name="password"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="" />
          <div v-if="form.errors.password" class="text-sm text-red-600">
            {{ form.errors.password }}
          </div>
        </div>
        <div class="mb-6 max-w-md">
          <select v-model="form.role">
            <option v-for="role in roles" :key="role.id" :value="role">
              {{ role }}
            </option>
          </select>
        </div>
        <button type="submit"
          class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
          :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
          Submit
        </button>
      </form>
    </div>
  </AppLayout>
</template>