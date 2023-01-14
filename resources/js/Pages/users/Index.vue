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
                ">Create User
            </Link>
            <table class="table-auto">
              <thead class="mt-8 text-lg">
                <tr>
                  <th class="border px-4 py-2">ID</th>
                  <th class="border px-4 py-2">Name</th>
                  <th class="border px-4 py-2">Email</th>
                  <th class="border px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td class="border px-4 py-2">{{ user.id }}</td>
                  <td class="border px-4 py-2">{{ user.name }}</td>
                  <td class="border px-4 py-2">{{ user.email }}</td>
                  <td class="border px-4 py-2">
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
