<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'
defineProps({
  users: Array,
});

const form = useForm();

function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route("users.destroy", id));
  }
}
</script>
<style scoped>
html,
body {
  height: 100%;
}

@media (min-width: 640px) {
  table {
    display: inline-table !important;
  }

  thead tr:not(:first-child) {
    display: none;
  }
}

td:not(:last-child) {
  border-bottom: 0;
}

th:not(:last-child) {
  border-bottom: 2px solid rgba(0, 0, 0, .1);
}
</style>
<template>
  <AppLayout title="Users">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </template>
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-4 bg-white border-b border-gray-200">
          <div class="col-12">
            <Link :href="route('users.create')" class="
                  bg-blue-500
                  hover:bg-blue-700
                  text-white
                  font-bold
                  py-2
                  px-4
                  rounded
                  block
                  max-w-fit
                ">Create User
            </Link>
            <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
            <thead class="text-white">
              <tr v-for="user in users" :key="user.id"
                class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="border p-3 h-14">ID</th>
                <th class="border p-3 h-14">Name</th>
                <th class="border p-3 h-14">Email</th>
                <th class="border p-3 h-14">Actions</th>
              </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
              <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0" v-for="user in users" :key="user.id">
                <td class="border-grey-light border hover:bg-gray-100 p-3 h-14 text-center">{{ user.id }}</td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 h-14 text-center">{{ user.name }}</td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 h-14 text-center">{{ user.email }}</td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 h-14 text-center">
                  <Link :href="route('users.edit', user.id)" class="
                          bg-blue-500
                          hover:bg-blue-700
                          text-white
                          font-bold
                          py-2
                          px-4
                          rounded-full
                        ">Edit</Link>
                  <button @click="destroy(user.id)" class="
                          bg-red-500
                          hover:bg-red-700
                          text-white text-sm
                          font-bold
                          py-2
                          px-4
                          rounded-full
                        ">
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
  </AppLayout>
</template>
